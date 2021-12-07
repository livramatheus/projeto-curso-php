var isLight = getCookie('isLight');

const closeModal = (e) => {
    const wrapper = document.querySelector('.erro-wrapper');   
    wrapper.remove();
    document.body.classList.remove('stop-scrolling');
}

const load = () => {
    const themeBtn     = document.querySelector(".theme-btn");
    const body         = document.querySelector("body");
    const erroClose    = document.querySelector(".erro-close");
    const novaConsulta = document.querySelector('.erro-nova-consulta');
    
    themeBtn.addEventListener("click", (e) => {
        const divImgHome = document.querySelector('.img-home');

        isLight = !JSON.parse(isLight);
        
        body.classList.toggle('dark');
        document.cookie = 'isLight=' + isLight;
        
        if (isLight) {
            if (divImgHome) {
                divImgHome.style.backgroundImage = "url('images/folha_light.svg')";
            }

            e.target.src = "images/moon.svg";
        } else {
            if (divImgHome) {
                divImgHome.style.backgroundImage = "url('images/folha_dark.svg')";
            }

            e.target.src = "images/sun.svg";
        }
    })
    
    if (erroClose && novaConsulta) {
        erroClose.addEventListener('click', closeModal, false);
        novaConsulta.addEventListener('click', closeModal, false);
        
        document.body.classList.add('stop-scrolling');
    }
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

window.addEventListener("load", (e) => load());