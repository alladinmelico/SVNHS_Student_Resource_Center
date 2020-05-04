const clock = document.getElementById('clock');

setInterval(function() {
    if (clock !== null) {
        clock.innerHTML = getCurrentTime();
    }
}, 1);

function getCurrentTime() {
    var currentDate = new Date();
    var hours = currentDate.getHours() > 12 ? currentDate.getHours() - 12 : currentDate.getHours();
    hours === 0 ? hours = 12 : hours = hours;
    var minutes = currentDate.getMinutes();
    var seconds = currentDate.getSeconds() < 10 ? '0' + currentDate.getSeconds() : currentDate.getSeconds();
    var currentTime = hours + ':' + minutes + ':' + seconds;
    return currentTime;
}

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