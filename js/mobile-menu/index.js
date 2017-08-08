import Slideout from 'slideout';

export default function init() {
  const slideout = new Slideout({
    'panel': document.getElementById('site'),
    'menu': document.getElementById('menu'),
    'padding': 256,
    'tolerance': 70
  });

  const toggle = document.getElementById('mobile-toggle');
  toggle.addEventListener('click', () => slideout.toggle());
}
