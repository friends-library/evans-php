import $ from 'jquery';

window.$ = $;
const slidebars = require('slidebars');

export default function initMobileMenu() {
  const controller = new slidebars();
  controller.init();

  $('.mobile-toggle').on('click', (e) => {
    e.stopPropagation();
    e.preventDefault();
    controller.toggle('menu');
  });
}
