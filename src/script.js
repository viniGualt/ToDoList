document.addEventListener('DOMContentLoaded', () => {

    // Alterar fundo do select

    const selects = document.querySelectorAll('select.updateBg')

    function updateSelectBg(select) {
        select.classList.remove('new', 'todo', 'doing', 'concluido')

        if (select.value === '0') {
            select.classList.add('new')
        } else if (select.value === '1') {
            select.classList.add('todo')
        } else if (select.value === '2') {
            select.classList.add('doing')
        } else if (select.value === '3') {
            select.classList.add('concluido')
        }
    }

    // Update de status no banco - Puxar informações do HTML e enviar via AJAX

    function sendStatus(select) {
        const status = select.value;
        const id = select.dataset.tarefaid;
        const request = new XMLHttpRequest();

        request.open("GET", "index.php?status=" + status + "&id=" + id)

        // request.onreadystatechange = () => {
        //     if (request.readyState === request.DONE) {
        //         console.log(request.responseText);
        //     }
        // };

        request.send();
    }

    // Itera sob os selects e faz os updates necessários no status

    selects.forEach(select => {

        updateSelectBg(select);

        select.addEventListener('change', () => {
            updateSelectBg(select);
            sendStatus(select);
        });
    });

    //  Alterar nome da empresa
    
    const title = document.getElementById('logo-title')
    
    title.addEventListener('mouseenter', () => {
        title.textContent = '2DOList'
    });
    
    title.addEventListener('mouseleave', () => {
        title.textContent = '2DO'
    })

});