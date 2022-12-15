window.addEventListener('DOMContentLoaded', event => {


    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});



function hideSideBar()
{
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle)
    {


        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    }

}
