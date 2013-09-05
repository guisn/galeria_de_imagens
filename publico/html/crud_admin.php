
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
        <link rel="stylesheet" type="text/css" href="publico/jquery-easyui-1.3.4/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="publico/jquery-easyui-1.3.4/themes/icon.css">
        <script type="text/javascript" src="publico/jquery-easyui-1.3.4/jquery.min.js"></script>
        <script type="text/javascript" src="publico/jquery-easyui-1.3.4/jquery.easyui.min.js"></script>
    </head>
    <body>
        <h2>Imagens</h2>

        <!-- Listagem -->
        <table id="dg" title="Imagens" class="easyui-datagrid" style="width:800px;height:600px;"
               url="get_users.php"
               toolbar="#toolbar" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="firstname" width="50">First Name</th>
                    <th field="lastname" width="50">Last Name</th>
                    <th field="phone" width="50">Phone</th>
                    <th field="email" width="50">Email</th>
                </tr>
            </thead>
        </table>
        
        
        <!-- Listagem > Toolbar -->
        <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Adicionar imagem</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove User</a>
        </div>

        
        <!-- Popup nova imagem -->
        <div id="dlg" class="easyui-dialog" style="width:400px;height:430px;padding:10px 20px"
             closed="true" buttons="#dlg-buttons">
            <div class="ftitle">Informações da imagem</div>
            <form id="fm" name="frmNovaImagem" method="post" enctype="multipart/form-data" novalidate>
                <div class="fitem">
                    <label>Imagem:</label>
                    <input type="file" name="arquivo_da_imagem" class="easyui-validatebox" required="true">
                </div>
                <div class="fitem">
                    <label>Nome:</label>
                    <input name="nome" class="easyui-validatebox" size="40" required="true">
                </div>
                <div class="fitem">
                    <label>Descrição:</label>
                    <textarea name="descricao" cols="35" rows="10"></textarea>
                </div>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
        </div>
        <script type="text/javascript">
                var url;
                function newUser() {
                    $('#dlg').dialog('open').dialog('setTitle', 'Nova imagem');
                    $('#fm').form('clear');
                    url = 'save_user.php';
                }
                function editUser() {
                    var row = $('#dg').datagrid('getSelected');
                    if (row) {
                        $('#dlg').dialog('open').dialog('setTitle', 'Edit User');
                        $('#fm').form('load', row);
                        url = 'update_user.php?id=' + row.id;
                    }
                }
                function saveUser() {
                    $('#fm').form('submit', {
                        url: url,
                        onSubmit: function() {
                            return $(this).form('validate');
                        },
                        success: function(result) {
                            var result = eval('(' + result + ')');
                            if (result.errorMsg) {
                                $.messager.show({
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            } else {
                                $('#dlg').dialog('close');        // close the dialog
                                $('#dg').datagrid('reload');    // reload the user data
                            }
                        }
                    });
                }
                function destroyUser() {
                    var row = $('#dg').datagrid('getSelected');
                    if (row) {
                        $.messager.confirm('Confirm', 'Are you sure you want to destroy this user?', function(r) {
                            if (r) {
                                $.post('destroy_user.php', {id: row.id}, function(result) {
                                    if (result.success) {
                                        $('#dg').datagrid('reload');    // reload the user data
                                    } else {
                                        $.messager.show({// show error message
                                            title: 'Error',
                                            msg: result.errorMsg
                                        });
                                    }
                                }, 'json');
                            }
                        });
                    }
                }
        </script>
        <style type="text/css">
            #fm{
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