let numeroSubtitulo = document.querySelector(".numeroSubtitulo");
const numero = { value: 0 };


gsap.to(numero, {
    duration: 3,
    value: 50,
    delay: 1,
    onStart: () => {
        numeroSubtitulo.innerHTML = Math.round(numero.value)+"%";
    },
    onUpdate: () => {
        numeroSubtitulo.innerHTML = Math.round(numero.value)+"%";
    },
    onComplete: () => {
        numeroSubtitulo.innerHTML = Math.round(numero.value)+"%";
    }
})

gsap.from('.textoAnimar', {
    duration: 1.5,
    x: -3000,
    stagger: 0.3
});

// tl.from('.banner__informacion__bajar', {
//     duration: 0.5,
//     y: -50,
//     delay: 0.8,
//     ease: "infinite",
// });

