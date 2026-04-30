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
        const wrapper = document.createElement('div');
        wrapper.className = 'relative flex items-center w-full';
        input.parentNode.insertBefore(wrapper, input);
        wrapper.appendChild(input);
        
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'absolute right-2 p-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors shadow-sm z-10';
        btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>`;
        wrapper.appendChild(btn);
        
        btn.addEventListener('click', function() {
            const cnpjLimpo = input.value.replace(/\D/g, '');
            if (cnpjLimpo === CNPJ_EXCECAO) {
                alert('Preenchimento manual habilitado para este CNPJ.');
                return;
            }
            if (cnpjLimpo.length !== 14) {
                alert('CNPJ inválido.');
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<span class="animate-spin text-xs">...</span>';

            fetch(`/api/consultar-cnpj?cnpj=${cnpjLimpo}`)
                .then(r => r.json())
                .then(data => {
                    if (data.error) alert(data.error);
                    else {
                        preencherCampo('razao_social', data.razao_social || data.nome);
                        preencherCampo('nome_fantasia', data.nome_fantasia || data.fantasia);
                        preencherCampo('endereco', data.logradouro ? `${data.logradouro}, ${data.numero}` : data.endereco);
                        preencherCampo('bairro', data.bairro);
                        preencherCampo('cidade', data.cidade || data.municipio);
                        preencherCampo('estado', data.estado || data.uf);
                        preencherCampo('cep', data.cep);
                    }
                }).finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>`;
                });
        });
    });

    // --- LÓGICA DE CEP (VIA CEP) ---
    document.querySelectorAll('input[name="cep"]').forEach(input => {
        input.addEventListener('blur', function() {
            const cep = this.value.replace(/\D/g, '');
            if (cep.length !== 8) return;

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(res => res.json())
                .then(data => {
                    if (!data.erro) {
                        preencherCampo('endereco', data.logradouro);
                        preencherCampo('bairro', data.bairro);
                        preencherCampo('cidade', data.localidade);
                        preencherCampo('estado', data.uf);
                    }
                });
        });
    });

    function preencherCampo(id, valor) {
        const campo = document.getElementById(id);
        if (campo && valor) {
            campo.value = valor;
            campo.dispatchEvent(new Event('input'));
        }
    }
});
