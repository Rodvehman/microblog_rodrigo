'use strict'

// Vai selecionar a classe excluit (.excluir)
const links = document.querySelectorAll('.excluir');

for (const link of links){
    link.addEventListener("click", function(event){
        event.preventDefault();

        let resposta = confirm("Tem certeza que deseja excluir?? A alteração não terá como ser revertida.");

        if(resposta){
            location.href=link.href;
        }
    });
}