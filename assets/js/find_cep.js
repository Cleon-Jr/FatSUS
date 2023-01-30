/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Limpa os campos
function limpaForm(){
    document.getElementById('rua').value = "";
    document.getElementById('bairro').value = "";
    document.getElementById('cidade').value = "";
    document.getElementById('estado').value = "";
    document.getElementById('cep').value = "";
    document.getElementById('cep').focus();
}



// callback
function my_callback(conteudo){
    if(!("Erro" in conteudo)){
        //Atualiza os campos com os valores encontrados
        document.getElementById('rua').value = (conteudo.logradouro);
        document.getElementById('bairro').value = (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('estado').value = (conteudo.uf);
    }
    else{
        //CEP n~ao encontrado
        limpaForm();
        alert('O CEP informado não foi encontrado!');
    }
}

// Procura pelo CEP informado
function searchCEP(valor){
    //recupera o valor do campo, guardando na variável somente os dígitos
    var  cep = valor.replace(/\D/g,'');
    
        if(cep != ""){
            //Expressão regular para validação do CEP
            var validacep = /^[0-9]{8}$/;
            
                // Valida o formato do CEP
                if(validacep.test(cep)){
                    //preenche os campos com "..." enuanto consulta o webservice
                    document.getElementById('rua').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('estado').value = "...";
                    
                    //Cria elemento javascript
                    var script = document.createElement('script');
                    
                    //sincroniza o callback
                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
                    
                    //Insere o script no documento e carrega o conteúdo
                    document.body.appenChild(script);
                }
                else{
                    //caso CEP inválido
                    limpaForm();
                    alert('Formato de CEP inválido! Tente novamente.')
                }
        }
        else{
            // Caso campo vazio
            limpaForm();
        }
}