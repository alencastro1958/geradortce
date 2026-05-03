document.addEventListener('DOMContentLoaded', function() {
    // --- MÁSCARAS GLOBAIS ---
    const masks = {
        cnpj: (v) => v.replace(/\D/g, '').replace(/^(\d{2})(\d)/, '$1.$2').replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3').replace(/\.(\d{3})(\d)/, '.$1/$2').replace(/(\d{4})(\d)/, '$1-$2'),
        cpf: (v) => v.replace(/\D/g, '').replace(/(\d{3})(\d)/, '$1.$2').replace(/(\d{3})(\d)/, '$1.$2').replace(/(\d{3})(\d{1,2})$/, '$1-$2'),
        cep: (v) => v.replace(/\D/g, '').replace(/(\d{5})(\d)/, '$1-$2'),
        tel: (v) => v.replace(/\D/g, '').replace(/^(\d{2})(\d)/, '($1) $2').replace(/(\d{4,5})(\d{4})$/, '$1-$2')
    };

    function applyMask(input, type) {
        input.addEventListener('input', (e) => {
            let val = e.target.value;
            if (masks[type]) e.target.value = masks[type](val);
        });
    }

    document.querySelectorAll('input[name="cnpj"]').forEach(i => applyMask(i, 'cnpj'));
    document.querySelectorAll('input[name="cpf"], input[name*="cpf"]').forEach(i => applyMask(i, 'cpf'));
    document.querySelectorAll('input[name="cep"], input[name*="cep"]').forEach(i => applyMask(i, 'cep'));
    document.querySelectorAll('input[name*="telefone"], input[name*="whatsapp"]').forEach(i => applyMask(i, 'tel'));

    // --- VALIDAÇÃO DE CPF ---
    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g,'');	
        if(cpf == '') return false;	
        if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999") return false;		
        add = 0;	
        for (i=0; i < 9; i ++) add += parseInt(cpf.charAt(i)) * (10 - i);	
        rev = 11 - (add % 11);	
        if (rev == 10 || rev == 11) rev = 0;	
        if (rev != parseInt(cpf.charAt(9))) return false;		
        add = 0;	
        for (i = 0; i < 10; i ++) add += parseInt(cpf.charAt(i)) * (11 - i);	
        rev = 11 - (add % 11);	
        if (rev == 10 || rev == 11) rev = 0;	
        if (rev != parseInt(cpf.charAt(10))) return false;		
        return true;   
    }

    document.querySelectorAll('input[name="cpf"]').forEach(i => {
        i.addEventListener('blur', function() {
            if (this.value && !validarCPF(this.value)) {
                alert('CPF Inválido!');
                this.classList.add('border-red-500');
            } else {
                this.classList.remove('border-red-500');
            }
        });
    });

    // --- LÓGICA DE CNPJ (ESTAGEE) ---
    const CNPJ_EXCECAO = "82951328000158";
    const cnpjInputs = document.querySelectorAll('input[name="cnpj"]');
    
    cnpjInputs.forEach(input => {
        const handleLookup = function() {
            const cnpjLimpo = input.value.replace(/\D/g, '');
            if (!cnpjLimpo || cnpjLimpo.length === 0) return;

            if (cnpjLimpo === CNPJ_EXCECAO) {
                console.log('Preenchimento manual habilitado para este CNPJ.');
                return;
            }

            if (cnpjLimpo.length !== 14) return;

            // Feedback visual de carregamento
            input.classList.add('opacity-50', 'cursor-wait');
            
            fetch(`/api/consultar-cnpj?cnpj=${cnpjLimpo}`)
                .then(r => r.json())
                .then(data => {
                    if (data.error) {
                        console.error('Busca CNPJ:', data.error);
                        // Não interrompe com alert, apenas loga e permite manual
                    } else {
                        preencherCampo('razao_social', data.razao_social || data.nome);
                        preencherCampo('nome_fantasia', data.nome_fantasia || data.fantasia);
                        preencherCampo('logradouro', data.logradouro || null);
                        preencherCampo('numero', data.numero || null);
                        preencherCampo('complemento', data.complemento || null);
                        preencherCampo('bairro', data.bairro);
                        preencherCampo('cidade', data.cidade || data.municipio);
                        preencherCampo('estado', data.estado || data.uf);
                        preencherCampo('cep', data.cep);
                        preencherCampo('endereco', montarEndereco(data.logradouro, data.numero, data.complemento, data.endereco));
                    }
                })
                .catch(err => console.error('Erro na requisição:', err))
                .finally(() => {
                    input.classList.remove('opacity-50', 'cursor-wait');
                    window.lastEvent = null;
                });
        };

        // Busca ao pressionar Enter
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                window.lastEvent = 'Enter';
                handleLookup();
            }
        });

        // Busca ao sair do campo (Blur)
        input.addEventListener('blur', function() {
            handleLookup();
        });
    });

    // --- LÓGICA DE CEP (VIA CEP) ---
    document.querySelectorAll('input[name="cep"]').forEach(input => {
        const buscarCep = () => {
            const cep = input.value.replace(/\D/g, '');
            if (cep.length !== 8) return;

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(res => res.json())
                .then(data => {
                    if (!data.erro) {
                        preencherCampo('logradouro', data.logradouro);
                        preencherCampo('endereco', montarEndereco(data.logradouro, null, null, null));
                        preencherCampo('bairro', data.bairro);
                        preencherCampo('cidade', data.localidade);
                        preencherCampo('estado', data.uf);
                    }
                });
        };

        input.addEventListener('blur', buscarCep);

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Impede o envio do formulário ao apertar Enter
                buscarCep();
            }
        });
    });

    function preencherCampo(id, valor) {
        const campo = document.getElementById(id);
        if (campo && valor) {
            campo.value = valor;
            campo.dispatchEvent(new Event('input'));
        }
    }

    function montarEndereco(logradouro, numero, complemento, enderecoFallback) {
        if (!logradouro) return enderecoFallback || null;
        let endereco = logradouro;
        if (numero) endereco += `, ${numero}`;
        if (complemento) endereco += ` - ${complemento}`;
        return endereco;
    }
});
