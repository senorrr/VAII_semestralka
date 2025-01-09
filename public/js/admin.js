//admin.index
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('spravovanie').addEventListener('change', function () {
        let selectedValue = this.value;
        if (selectedValue === 'Kategórie') {
            window.location.href = 'http://localhost/?c=admin&a=category';
        } else if (selectedValue === 'Inzeráty') {
            window.location.href = 'inzeraty.php';
        } else if (selectedValue === 'Domov') {
            window.location.href = 'http://localhost/?c=admin';
        }
    });
})