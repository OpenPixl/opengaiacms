// déclaration des constructeurs
// déclaration des fonctions
const modalBlock = document.getElementById('modalBlock')
const addBlock = new bootstrap.Modal(modalBlock, { keyboard: true })

// déclaration des modals
modalBlock.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    let a = event.relatedTarget
    // extraction de la variable
    let recipient = a.getAttribute('data-bs-id')
    let crud = recipient.split('-')[0]
    let contentTitle = recipient.split('-')[1]
    let id = recipient.split('-')[2]
    let namePage = recipient.split('-')[3]
    if(crud === "ADD")
    {
        let modalHeaderH5 = modalBlock.querySelector('.modal-title')
        modalHeaderH5.textContent = contentTitle
    }else if(crud === "EDIT")
    {
        let url = a.href
        let modalHeaderH5 = modalBlock.querySelector('.modal-title')
        let modalBody = modalBlock.querySelector('.modal-body')
        modalHeaderH5.textContent = contentTitle
        axios
            .get(url)
            .then(function(response){
                modalBody.innerHTML = response.data.formView
            })
    }
})
// déclaration des fonctions
function blockChoice(event){
    event.preventDefault()
    let url = this.href
    axios
        .post(url)
        .then(function(response){
            document.getElementById('liste').innerHTML = response.data.liste
            addBlock.hide()
        })
        .catch()
}
// déclaration des déclencheurs d'évènements
document.querySelectorAll('a.blockChoice').forEach(function (link){
    link.addEventListener('click', blockChoice);
})

// déclaration des déclencheurs d'évènements
document.querySelectorAll('a.blockChoice').forEach(function (link){
    link.addEventListener('click', blockChoice);
})
