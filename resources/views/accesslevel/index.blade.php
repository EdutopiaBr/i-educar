@extends('layout.default')

@section('content')

    <div id="app-content">
        <access-level-menu></access-level-menu>
    </div>

@endsection

@push('script')
    <div id="access-level-menu-radiogroup" class="vue-template">
        <div id="radiogroup">
            <div class="radiogroup">
                <input :id="'acl-3' + hash" :checked="value === 3" @input="$emit('input', 3)" type="radio">
                <label :for="'acl-3' + hash">
                    <span>Exclui</span>
                </label>
                <input :id="'acl-2' + hash" :checked="value === 2" @input="$emit('input', 2)" type="radio">
                <label :for="'acl-2' + hash">
                    <span>Cadastra</span>
                </label>
                <input :id="'acl-1' + hash" :checked="value === 1" @input="$emit('input', 1)" type="radio">
                <label :for="'acl-1' + hash">
                    <span>Visualiza</span>
                </label>
                <input :id="'acl-0' + hash" :checked="value === 0" @input="$emit('input', 0)" type="radio">
                <label :for="'acl-0' + hash">
                    <span>Sem permissão</span>
                </label>
            </div>
        </div>
    </div>
    <div id="access-level-menu" class="vue-template">
        <div class="access-level-menu">
            @{{ radio }}
            <form id="formcadastro" action="" method="post">
                <table width="100%">
                    <tbody>
                        <tr><td class="formdktd" colspan="2" height="24"><b>Novo </b></td></tr>
                        <tr id="tr_nm_tipo"><td class="formmdtd" valign="top"><span class="form">Tipo de Usuário</span><span class="campo_obrigatorio">*</span></td><td class="formmdtd" valign="top"><span class="form">
<input class="obrigatorio" type="text" name="nm_tipo" id="nm_tipo" value="" size="40" maxlength="255"> </span></td></tr>
                        <tr id="tr_nivel"><td class="formlttd" valign="top"><span class="form">Nível</span><span class="campo_obrigatorio">*</span></td><td class="formlttd" valign="top"><span class="form">
<select onchange="" class="obrigatorio" name="nivel" id="nivel" style="width: 142px;"><option id="nivel_8" value="8">Biblioteca</option><option id="nivel_4" value="4">Escola</option><option id="nivel_2" value="2">Institucional</option><option id="nivel_1" value="1">Poli-institucional</option></select> </span></td></tr>
                        <tr id="tr_descricao"><td class="formmdtd" valign="top"><span class="form">Descrição</span></td><td class="formmdtd" valign="top"><span class="form">
<textarea class="geral" name="descricao" id="descricao" cols="37" rows="5" style="wrap:virtual"></textarea>
</span></td></tr>
                    </tbody>
                </table>
                <table width="100%">
                    <tbody>
                        <tr><td colspan="2"><hr></td></tr>
                        <tr>
                            <td class="formlttd"><span class="form">Procure pelo nome do menu: </span><input type="text" v-model="search" placeholder="Digite o menu que procura" style="width: 300px;"></td>
                            <td class="formlttd">
                                <button type="button" @click="log">Show</button>

                                <access-level-menu-radiogroup v-model="radio['32']"></access-level-menu-radiogroup>
                                <div>
                                    <button type="button">Sem permissão</button>
                                    <button type="button">Visualiza</button>
                                    <button type="button">Cadastra</button>
                                    <button type="button">Exclui</button>
                                </div>
                            </td>
                        </tr>
                        <template v-for="menu in menus">
                        <tr><td colspan="2"><hr></td></tr>
                        <tr>
                            <td class="formlttd" colspan="2" height="24">
                                <b>@{{ menu.menu.title }}</b>
                            </td>
                        </tr>
                        <tr v-for="(process, i) in menu.processes" v-if="process.title.toLowerCase().includes(search.toLowerCase())">
                            <td :class="{ formmdtd: i % 2 == 0, formlttd: i % 2 != 0 }">
                                <span class="form">@{{ process.title }}</span>
                                <br>
                                <a :href="process.link"><sup>@{{ process.description }}</sup></a>
                            </td>
                            <td :class="{ formmdtd: i % 2 == 0, formlttd: i % 2 != 0 }" width="500">
                                <access-level-menu-radiogroup v-model="process.level"></access-level-menu-radiogroup>
                            </td>
                        </tr>
                        </template>
                        <tr><td class="tableDetalheLinhaSeparador" colspan="2"></td></tr>
                        <tr class="linhaBotoes"><td colspan="2" align="center">
                            <input type="button" id="btn_enviar" class="botaolistagem" onclick="acao();" value="Salvar">&nbsp;&nbsp;<input type="button" class="botaolistagem" onclick="javascript:  go( &quot;educar_tipo_usuario_lst.php&quot; );" value=" Cancelar ">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <style>
        .radiogroup {
            float: left;
            border: solid 1px #cddce6;
            border-radius: 3px;
        }
        .radiogroup input[type=radio] {
            display: none;
        }
        .radiogroup label {
            float: right;
            background-color: #ffffff;
            padding: 3px 8px;
            font-size: 14px;
            color: #47728f;
            box-sizing: border-box;
            cursor: pointer;
        }
        .radiogroup label {
            border-left: solid 1px #cddce6;
        }
        .radiogroup label:last-child {
            border-left: none;
        }
        .radiogroup label:first-child {
            border-radius: 0 3px 3px 0;
        }
        .radiogroup > input:checked ~ label,
        .radiogroup:not(:checked) > label:hover,
        .radiogroup:not(:checked) > label:hover ~ label {
            background: #d9e8f2;
        }
        .radiogroup > input:checked + label:hover,
        .radiogroup > input:checked ~ label:hover,
        .radiogroup > label:hover ~ input:checked ~ label,
        .radiogroup > input:checked ~ label:hover ~ label {
            background-color: #cddce6;
        }
    </style>
    <script>
        Vue.component('access-level-menu-radiogroup', {
            template: '#access-level-menu-radiogroup',
            props: {
                value: {
                    type: Number,
                    default: 0
                }
            },
            data: function () {
                return {
                    radio: 0,
                    hash: Math.random().toString(36).substr(2, 9)
                };
            },
        });

        Vue.component('access-level-menu', {
            template: '#access-level-menu',
            methods: {
                log: function () {
                    console.log(JSON.stringify(this.menus[0].processes));
                }
            },
            data: function () {
                return {
                    menus: @json($menus),
                    search: '',
                    radio: 0
                };
            },
        });

        new Vue({
            el: '#app-content'
        });
    </script>
@endpush
