import 'babel-polyfill';
import Vue from 'vue';

const moment = require('moment');
moment.locale('ru');

import contactsMap from './contacts-map';

document.addEventListener('DOMContentLoaded', () => {
    contactsMap.init();
});

$('.main-slick').slick({
    slidesToShow: 1,
    autoplay: false,
    autoplaySpeed: 3000,
    arrows: true,
    dots: true,
    swipeToSlide: true,
});

$('.projects-slick').slick({
    slidesToShow: 1,
    centerMode: true,
    centerPadding: '500px',
    autoplay: false,
    autoplaySpeed: 3000,
    arrows: true,
    dots: false,
    swipeToSlide: true,
     responsive: [
    {
      breakpoint: 1600,
      settings: {
        arrows: true,
        centerMode: true,
        centerPadding: '350px',
      }
    },
    {
      breakpoint: 1280,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '200px',
        slidesToShow: 1
      }
    }
  ]
});

import { Calendar } from '@toast-ui/vue-calendar';

let elVue = "#app";
let elVueQuery = document.querySelector(elVue);

if (elVueQuery) {
    const app = new Vue({
        el: elVue,
        delimiters: ["((", "))"],
        components: {
            'calendar': Calendar
        },
        data: {
            dateRange: '',
            webinar: {
                price: '',
                name_module: '',
                link_module: '',
            },
            user: {
                name: '',
                phone: ''
            },
            calendarData: {
                calendarList: [],
                scheduleList: [],
                view: 'month',
                scheduleView: ['time'],
                theme: {
                    'month.dayname.height': '30px',
                    'month.dayname.textAlign': 'center',
                    'week.today.color': '#ff4040',
                    'week.daygridLeft.width': '100px',
                    'week.timegridLeft.width': '100px',
                    'month.day.fontSize': '14px',
                },
                week: {},
                month: {
                    daynames: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                    visibleWeeksCount: 6,
                    startDayOfWeek: 1,
                },
                isReadOnly: true,
            }
        },
        watch: {},
        computed: {},
        mounted() {
            this.setRenderRangeText();

            let course_modules = SITEDATA.modules;
            let new_course_modules = [];
            course_modules.forEach(
                (course_module, index) => { 
                    let new_course_module = {
                        id: index,
                        title: course_module.title,
                        category: 'time',
                        dueDateClass: '',
                        start: course_module.time_start,
                        end: course_module.time_end
                    };
                    new_course_modules.push(new_course_module);
                }
            );
            this.calendarData.scheduleList = new_course_modules;

            let indexFirstRef = Object.keys(this.$refs).find(function(ref) {
                return ref.includes('module');
            });
            let price = this.$refs[indexFirstRef].getAttribute('data-price');
            let name_module = this.$refs[indexFirstRef].getAttribute('data-name_module');
            let link_module = this.$refs[indexFirstRef].getAttribute('data-link_module');
            this.setPrice(price, name_module, link_module, indexFirstRef);
        },
        methods: {
            showModal: (modalName) => {
                const currentModal = document.querySelector(`.${modalName}`);
                const overlay = document.querySelector('.overlay');
                if (currentModal) {
                    currentModal.classList.add('modal--show');
                    overlay.classList.add('overlay--show');
                }
            },

            closeModal: () => {
                const overlay = document.querySelector('.overlay');
                const modals = document.querySelectorAll('.modal-window');
                modals.forEach(modal => {
                    modal.classList.remove('modal--show');
                    overlay.classList.remove('overlay--show');
                });
            },

            setPrice(price, name_module, link_module, ref){
                this.webinar.price = price;
                this.webinar.name_module = name_module;
                this.webinar.link_module = link_module;
                let refsArray = Object.values(this.$refs);
                refsArray.forEach(
                    ref => {
                        ref.classList.remove('active');
                    }
                );

                this.$refs[ref].classList.toggle('active');

                let targetScroll = event.target.parentNode.parentNode;
                if(targetScroll){
                    targetScroll.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                        inline: "nearest"
                    })
                }
            },
            
            async submitModuleForm(){
                let formReg = new FormData(); 
                formReg.append("name", this.user.name);
                formReg.append("phone", this.user.phone);
                formReg.append("price", this.webinar.price);
                formReg.append("name_module", this.webinar.name_module);
    
                let fetchData = {
                    method: "POST",
                    body: formReg
                };

                const sendURL = `${SITEDATA.themepath}/email-send.php`;
                let response = await fetch(sendURL, fetchData);
                let responseData = await response.json();
                if(responseData.status == 'success'){
                    this.showModal('modal-window--thank')
                }
                else{
                    this.showModal('modal-window--error')
                }                
            },

            prevCalendar(){
                this.$refs.tuiCalendar.invoke('prev');
                this.setRenderRangeText();
            },
            nextCalendar(){
                this.$refs.tuiCalendar.invoke('next');  
                this.setRenderRangeText();
            },

            setRenderRangeText() {
                const {invoke} = this.$refs.tuiCalendar;
                const view = invoke('getViewName');
                const calDate = invoke('getDate');
                const rangeStart = invoke('getDateRangeStart');
                const rangeEnd = invoke('getDateRangeEnd');
                let year = calDate.getFullYear();
                let month = calDate.getMonth() + 1;
                let date = calDate.getDate();
                let dateRangeText = '';
                let endMonth, endDate, start, end;
                switch (view) {
                  case 'month':
                    dateRangeText = `${year}-${month}`;
                    break;
                  case 'week':
                    year = rangeStart.getFullYear();
                    month = rangeStart.getMonth() + 1;
                    date = rangeStart.getDate();
                    endMonth = rangeEnd.getMonth() + 1;
                    endDate = rangeEnd.getDate();
                    start = `${year}-${month}-${date}`;
                    end = `${endMonth}-${endDate}`;
                    dateRangeText = `${start} ~ ${end}`;
                    break;
                  default:
                    dateRangeText = `${year}-${month}-${date}`;
                }
                this.dateRange = moment(dateRangeText).format('MMMM YYYY');
            },

        },
    })
};
