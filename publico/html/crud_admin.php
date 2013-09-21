
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
        <link rel="stylesheet" type="text/css" href="../publico/jquery-easyui-1.3.4/themes/black/easyui.css">
        <link rel="stylesheet" type="text/css" href="../publico/jquery-easyui-1.3.4/themes/icon.css">
        <script type="text/javascript" src="../publico/jquery-easyui-1.3.4/jquery.min.js"></script>
        <script type="text/javascript" src="../publico/jquery-easyui-1.3.4/jquery.easyui.min.js"></script>

    </head>
    <body>

        <!-- Listagem -->
        <table id="dg" title="Imagens" class="easyui-datagrid" heigth="900"
               url="ajax_crud_galeria.php?tarefa=listaTodasAsImagens"
               toolbar="#toolbar" pagination="false"
               rownumbers="true" fitColumns="true" singleSelect="false"
               loadMsg="Aguarde...">
            <thead>
                <tr>
                    <th data-options="field:'id',checkbox:true">ID</th>
                    <th data-options="field:'imagem'">Imagem</th>
                    <th data-options="field:'nome'">Nome</th>
                    <th data-options="field:'descricao'">Descrição</th>
                    <th data-options="field:'ordem'">Ordem</th>
                </tr>
            </thead>
        </table>


        <!-- Listagem > Toolbar -->
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="btnInsereImagem()">Adicionar imagem</a>
            <!--
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="btnEditarDadosDeImagem()">Editar imagem</a>
            -->
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="btnRemoverImagens()">Remover imagem</a>
        </div>


        <!-- Popup nova imagem -->
        <div id="dlg" class="easyui-dialog" style="width:400px;height:430px;padding:10px 20px"
             closed="true" buttons="#dlg-buttons">
            <div class="ftitle">Informações da imagem</div>
            <form id="form" name="frmNovaImagem" method="post" enctype="multipart/form-data">
                <div class="fitem">
                    <label>Imagem:</label>
                    <input type="file" name="arquivo_da_imagem">
                </div>
                <div class="fitem">
                    <label>Nome:</label>
                    <input name="nome" class="easyui-validatebox" size="40" data-options="required:true">
                </div>
                <div class="fitem">
                    <label title="Ordem em que aparece na galeria.">Ordem:</label><br>
                    <input name="ordem" size="3">
                </div>
                <div class="fitem">
                    <label>Descrição:</label>
                    <textarea name="descricao" cols="35" rows="10"></textarea>
                </div>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="btnSalvaDadosDeImagem()">Salvar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancelar</a>
        </div>
        <script type="text/javascript">
           
            
            $(window).resize(function() {
                $('#dg').datagrid('resize');
            });
            
            var url;
            function btnInsereImagem() {
                $('#dlg').dialog('open').dialog('setTitle', 'Nova imagem');
                $('#form').form('clear');
                url = 'ajax_crud_galeria.php?tarefa=insereImagem';
            }
            
            function btnEditarDadosDeImagem() {
                /*
                var row = $('#dg').datagrid('getChecked');
                if (row) {
                    $('#dlg').dialog('open').dialog('setTitle', 'Editar dados da imagem');
                    $('#form').form('load', row);
                    url = 'update_user.php?id=' + row.id;
                }
                */
            }
            
            function btnSalvaDadosDeImagem() {
                $('#form').form({
                    url: url,
                    onSubmit: function(){
                        var isValid = $(this).form('validate');
                        $.messager.progress();
                        
                        if (!isValid) {
                            $.messager.progress('close');
                            return false;
                        }
                    },
                            
                    success:function(retorno_do_ajax){
                        var objetoJSON = eval('(' + retorno_do_ajax + ')');
                        
                        if (objetoJSON.falha != null) {
                            $.messager.progress('close');
                            alert(objetoJSON.falha);
                            return false;
                        }
                        
                        $.messager.progress('close');
                        $.messager.alert('Sucesso', 'A imagem foi inserida com sucesso!');
                        
                        $('#dlg').dialog('close');
                        $('#form').form('clear');
                        $('#dg').datagrid('reload');
                    }
                });
                
                // submit the form
                $('#form').submit();
            }
            
            
            
            
            function btnRemoverImagens() {
                var rows = $('#dg').datagrid('getChecked');
                //console.log(rows[0]);
                
                if (rows.length > 0) {
                    $.messager.confirm('Confirmação', 'Tem certeza que deseja excluir as imagens selecionadas?', function(retorno_do_confirm) {
                        
                        if (retorno_do_confirm) {
                            
                            $.post('ajax_crud_galeria.php', {'tarefa': 'excluiImagens', 'parametros_da_tarefa': rows}, function(retorno_do_ajax) {
                                
                                console.log(retorno_do_ajax);
                                if (retorno_do_ajax.sucesso) {
                                    $('#dg').datagrid('reload');
                                } else {
                                    $.messager.show({
                                        title: 'Error',
                                        msg: retorno_do_ajax.falha
                                    });
                                }
                                
                            }, 'json');
                            
                        }
                    });
                } else {
                    $.messager.alert('Aviso','Nenhuma imagem foi selecionada.', 'info');
                }
                
            }
        </script>
        <style type="text/css">
            body {
                margin: 0px;
                background-color: black;
            }
            
            #form{
                margin:0;
                padding:10px 30px;
            }
            .ftitle{
                font-size:14px;
                font-weight:bold;
                padding:5px 0;
                margin-bottom:10px;
                border-bottom:1px solid #ccc;
            }
            .fitem{
                margin-bottom:5px;
            }
            .fitem label{
                display:inline-block;
                width:80px;
            }
        </style>
    </body>
</html>