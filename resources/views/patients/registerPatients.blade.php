<head>
   
<link rel="stylesheet" href="{{ asset('css/registerPatients.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/inputmask/dist/jquery.inputmask.bundle.min.js"></script>


<script>
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de endereco.
            document.getElementById('cep').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {

            //Atualiza o campo com os valores.
            document.getElementById('endereco').value=(conteudo.logradouro);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                document.getElementById('endereco').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>

</head>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cadastro de Pacientes') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('patients.store') }}">
                            @csrf

                            @if($errors->any())
                                <div class="form-group">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="nome">{{ __('Nome') }}</label>
                                <input id="nome" type="text" class="form-control" name="nome_paciente" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="cpf">{{ __('CPF') }}</label>
                                <input id="cpf" type="text" class="form-control cpf" name="cpf_paciente" required>
                            </div>
                            
                            <label for="telefone">{{ __('Telefone') }}</label>
                            <div id="inputs-container">
                                <div class="input-wrapper">
                                    <input id="telefone" type="text" class="form-control" name="telefone_paciente" required>
                                    <span class="add-input" title="Adicionar telefone" onclick="addInput()">+</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control" name="email_paciente" required>
                            </div>

                            <div class="form-group">
                                <label for="cep">{{ __('CEP') }}</label>
                                <input id="cep" type="text" class="form-control" name="cep_paciente" onblur=pesquisacep(this.value); required>
                            </div>

                            <div class="form-group">
                                <label for="endereco">{{ __('Endereço') }}</label>
                                <input id="endereco" type="text" class="form-control" name="endereco_paciente" required>
                            </div>

                            <div class="form-group">
                                <label for="numero">{{ __('Número') }}</label>
                                <input id="numero" type="text" class="form-control" name="numero_paciente" required>
                            </div>

                            <div class="form-group">
                                <label for="numero">{{ __('Data de nascimento') }}</label>
                                <input id="dataNascimento" type="date" class="form-control" name="data_nascimento" onchange="verificarIdade()" required>
                            </div>

                            
                            <div class="form-group" style="display: none" id="responsavelNome">
                                <label for="nomeResponsavel">{{ __('Nome do responsável') }}</label>
                                <input id="nomeResponsavel" type="text" class="form-control" name="nome_responsavel" autofocus>
                            </div>

                            <div class="form-group" style="display: none" id="responsavelCpf">
                                <label for="cpfResponsavel">{{ __('CPF do responsável') }}</label>
                                <input id="cpfResponsavel" type="text" class="form-control cpf" name="Cpf_responsavel">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar Paciente') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
        $(document).ready(function () {
            $('.cpf').inputmask('999.999.999-99', { removeMaskOnSubmit: true });
            $('#telefone').inputmask('(99) 99999-9999', { removeMaskOnSubmit: true });
            $('#cep').inputmask('99999-999', { removeMaskOnSubmit: true });

        });


    function addInput() {
        const inputsContainer = document.getElementById('inputs-container');
        const inputWrapper = document.createElement('div');
        inputWrapper.classList.add('input-wrapper');

        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'telefone_paciente';
        newInput.id = 'telefone';
        newInput.placeholder = 'Digite o telefone';

        const plusSign = document.createElement('span');
        plusSign.classList.add('add-input');
        plusSign.textContent = '+';
        plusSign.onclick = addInput;

        inputWrapper.appendChild(newInput);
        inputWrapper.appendChild(plusSign);
        inputsContainer.appendChild(inputWrapper);
    }


    function verificarIdade() {
        const dataNascimentoInput = document.getElementById('dataNascimento');
        const responsavelFields = document.getElementById('responsavelFields');

        if (dataNascimentoInput.value) {
            const dataNascimento = new Date(dataNascimentoInput.value);
            const hoje = new Date();

            const diffAnos = hoje.getFullYear() - dataNascimento.getFullYear();
            const diffMeses = hoje.getMonth() - dataNascimento.getMonth();

            if (diffAnos < 18 || (diffAnos === 18 && diffMeses < 0)) {
                // Menor que 18 anos, exibir campos do responsável
                responsavelNome.style.display = 'block';
                responsavelCpf.style.display = 'block';
                responsavelNome.required = true;
                responsavelCpf.required = true;
            } else {
                // Maior ou igual a 18 anos, ocultar campos do responsável
                responsavelNome.style.display = 'none';
                responsavelCpf.style.display = 'none';
                responsavelNome.required = false;
                responsavelCpf.required = false;
            }
        }
    }


</script>


