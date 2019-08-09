import '~/slick-carousel/slick/slick.js';
import '~/slick-carousel/slick/slick.css';

$(document).ready(()=>{
  $('.conferences-wrapper').slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: $('button[name="prev-day"]'),
    nextArrow: $('button[name="next-day"]'),
  });
})
window.gotoDay = (i) => {
 $('.conferences-wrapper').slick('slickGoTo', i);
}
