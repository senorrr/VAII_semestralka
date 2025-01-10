//admin.index
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('spravovanie').addEventListener('change', function () {
        let selectedValue = this.value;
        if (selectedValue === 'Kategórie') {
            window.location.href = 'http://127.0.0.1/?c=admin&a=category';
        } else if (selectedValue === 'Užívatelia') {
            window.location.href = 'http://127.0.0.1/?c=admin&a=users';
        } else if (selectedValue === 'Domov') {
            window.location.href = 'http://127.0.0.1/?c=admin';
        }
    });
})