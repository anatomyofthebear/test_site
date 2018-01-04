ymaps.ready(init);
var myMap;

function init(){     
    myMap = new ymaps.Map ("map", {
        center: [55.76, 37.64],
        zoom: 2
    });




    myMap.controls
        // Кнопка изменения масштаба.
        .add('zoomControl', { left: 5, top: 5 })
        // Список типов карты
        .add('typeSelector')
        // Стандартный набор кнопок
        .add('mapTools', { left: 35, top: 5 });


};

