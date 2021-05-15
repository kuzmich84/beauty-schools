function getYandexMap(latitude, longitude ) {
    ymaps.ready(init);
    function init(){
        // Создание карты.
        var myMap = new ymaps.Map("map", {
            // Координаты центра карты.
            // Порядок по умолчанию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.
            center: [latitude, longitude ],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 14,
            controls: [
                'zoomControl',
                'routeButtonControl'
            ]
        });


        myMap.behaviors.disable('scrollZoom');

        var myPlacemark;

        myMap.setCenter([latitude,longitude]);
        // Если метка уже создана – просто передвигаем ее.
        if (myPlacemark) {
            myPlacemark.geometry.setCoordinates([latitude,longitude]);
        }
        // Если нет – создаем.
        else {
            myPlacemark = createPlacemark([latitude,longitude]);
            myMap.geoObjects.add(myPlacemark);
        }


        // Создание метки.
        function createPlacemark(coords) {
            return new ymaps.Placemark(coords);
        }
    }
}