const alertBanner = document.querySelector('.alert');
const menu = document.querySelectorAll('.menu-item .badge');
const modalActivate = document.getElementById('modal-activate');


if (alertBanner) {
    alertBanner.addEventListener('click', (event) => {
        event.toElement.parentElement.remove();
    });
}

(function menuContent() {
    menu.forEach(item => {
        item.addEventListener('click', () => {
            document.getElementById(item.dataset.target).classList.toggle("menu-item-content-active");
            console.log(item.dataset.target);
        })
    });
})();


function menuClassContent() {
    document.getElementById("class-content").classList.toggle("menu-item-content-active");
}

function menuToDoContent() {
    document.getElementById("todo-content").classList.toggle("menu-item-content-active");
}

function menuProfileContent() {
    document.getElementById("profile-content").classList.toggle("menu-item-content-active");
}

function modalOpen(modal) {
    const modalTarget = document.getElementById(modal.dataset.target);
    if (modal.dataset.target == 'modal-activate') {
        document.getElementById('nameActivate').innerText = modal.value.split(',')[0];
        document.getElementById('inputAction').value = modal.getAttribute('name');
        document.getElementById('inputId').value = modal.value.split(',')[1];
    } else if (modal.dataset.target == 'modal-delete') {
        document.getElementById('nameDelete').innerText = modal.value.split(',')[0];
        document.getElementById('inputActionDelete').value = modal.getAttribute('name');
        document.getElementById('inputIdDelete').value = modal.value.split(',')[1];
    }
    modalTarget.style.display = "flex";
}

function modalClose(modal) {
    const modalTarget = document.getElementById(modal.dataset.target);
    modalTarget.style.display = "none";
}

window.onclick = (event) => {
    let modal = event.target;
    if (modal.getAttribute('class') == "modal") {
        modal.style.display = "none";
    }
}