"use strict";

// gsap.from('.navbar',{
//     duration: 0.5,
//     y: -100,
//     delay: 2
// });
gsap.from('.textoAnimar', {
  duration: 1.5,
  x: -3000,
  stagger: 0.3
});
tl.from('.banner__informacion__bajar', {
  duration: 0.5,
  y: -50,
  delay: 0.8,
  ease: "infinite"
});
var numeroTitulo = document.querySelector(".numeroSubtitulo");
var numero = {
  value: 0
};
gsap.to(numero, {
  duration: 3,
  value: 50,
  delay: 1,
  onStart: function onStart() {
    numeroTitulo.innerHTML = Math.round(numero.value) + "%";
  },
  onUpdate: function onUpdate() {
    numeroTitulo.innerHTML = Math.round(numero.value) + "%";
  },
  onComplete: function onComplete() {
    numeroTitulo.innerHTML = Math.round(numero.value) + "%";
  }
});