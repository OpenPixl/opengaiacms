// déclaration des constructeurs
// déclaration des fonctions
const modalBlock = document.getElementById('modalBlock')
const addBlock = new bootstrap.Modal(modalBlock, { keyboard: true })
// déclaration des modals

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
