import 'babel-polyfill';
import Vue from 'vue';

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
            webinar: {
                price: ''
            },
            calendarData: {
                calendarList: [],
                scheduleList: [
                    {
                        id: '1',
                        title: 'Модуль 1',
                        category: 'time',
                        dueDateClass: '',
                        start: '2019-12-26T17:30:00+09:00',
                        end: '2019-12-26T17:31:00+09:00'
                    },
                    {
                        id: '2',
                        title: 'Модуль 2',
                        category: 'time',
                        dueDateClass: '',
                        start: '2019-12-21T17:30:00+09:00',
                        end: '2019-12-21T17:31:00+09:00'
                    }
                ],
                view: 'month',
                taskView: false,
                scheduleView: ['time'],
                theme: {
                    'month.dayname.height': '30px',
                    'month.dayname.textAlign': 'center',
                    'week.today.color': '#ff4040',
                    'week.daygridLeft.width': '100px',
                    'week.timegridLeft.width': '100px',
                    'month.day.fontSize': '14px',
                },
                week: {
                    // narrowWeekend: true,
                    // showTimezoneCollapseButton: true,
                    // timezonesCollapsed: false,
                },
                month: {
                    // daynames: ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sa'],
                    visibleWeeksCount: 6,
                    startDayOfWeek: 1
                },
                timezones: [
                    {
                        timezoneOffset: -420,
                        displayLabel: 'GMT-08:00',
                        tooltip: 'Los Angeles'
                    }
                ],
                disableDblClick: true,
                isReadOnly: true,
                template: {
                    milestone: function(schedule) {
                        return `<span style="color:red;">${schedule.title}</span>`;
                    },
                    milestoneTitle: function() {
                        return 'MILESTONE';
                    },
                },
                useCreationPopup: false,
                useDetailPopup: false,
            }
        },
        watch: {},
        computed: {},
        mounted() {
            let indexFirstRef = Object.keys(this.$refs).find(function(ref) {
                return ref.includes('module');
            });
            this.setPrice(this.$refs[indexFirstRef].getAttribute('data-price'), indexFirstRef);
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

            setPrice(price, ref){
                this.webinar.price = price;
                console.log(ref);
                this.$refs[ref].classList.toggle('active');
            }
        },
    })
};