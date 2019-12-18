const contactsMap = {
    init: () => {
        const contactMapsElement = document.querySelector('#map');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.intersectionRatio > 0) {
                    if (contactMapsElement) {
                        ymaps.ready(function () {
                            var myMap = new ymaps.Map('map', {
                                    center: [55.745168, 37.706603],
                                    zoom: 16.8  
                                }, {
                                    searchControlProvider: 'yandex#search'
                                }),

                                myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                                    hintContent: 'Росинтер',
                                    balloonContent: 'Москва, ул. Душинская, д. 7, стр. 1'
                                }, {
                                    preset: 'islands#circleIcon',
                                    iconColor: '#ed4543'
                                });

                            myMap.geoObjects
                                .add(myPlacemark);
                        });
                    }
                    observer.unobserve(entry.target);
                }
            });
        });
        if (contactMapsElement) {
            observer.observe(contactMapsElement);
        }
    }
}

module.exports = contactsMap;