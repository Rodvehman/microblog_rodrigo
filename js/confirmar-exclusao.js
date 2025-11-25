'use strict';

const links = document.querySelectorAll('.excluir');


for(const link of links){
    link.addEventListener("click",function(event){
        event.preventDefault();

        let resposta = confirm("Atenção!!!!!!!!!!!!!!! Deseja realmente excluir esse registro?");

        if(resposta){
            location.href = link.href;
        }

    });
}