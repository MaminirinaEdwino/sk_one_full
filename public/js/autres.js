// toggle du modale d'ajout de membre equipe

document.getElementById('modale-add-membre').style.display = "none"
document.getElementById('add-membre-button').addEventListener('click', (e)=>{
   document.getElementById('modale-add-membre').style.display == 'none'?  document.getElementById('modale-add-membre').style.display = "block":  document.getElementById('modale-add-membre').style.display = "none"
})