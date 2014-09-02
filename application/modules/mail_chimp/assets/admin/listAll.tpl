
<div class="container">

    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">MailChimp</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/modules_table" class="t-d_n m-r_15">
                        <span class="f-s_14">←</span> 
                        <span class="t-d_u">назад</span>
                    </a>
                </div>
                
            </div>                            
        </div>
        <div class="row-fluid">
           
                <table class="table  table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            
                            <th>Id</th>
                            <th>Назва</th>
                            <th>Создан</th>
                            
                        </tr>    
                    </thead>
                    <tbody class="">
                        {foreach $lists['data'] as $data}
                            <tr>
                                
                                <td>
                                    <a class="pjax" 
                                       href="/admin/components/init_window/mail_chimp/edit_list/{echo $data['id']}" 
                                      >
                                        {echo $data['id']}
                                    </a>
                                </td>
                                <td>
                                    <label>{echo $data['name']}</label>
                                </td>
                                <td>
                                    <label>{echo $data['date_created']}</label>
                                </td>
                                
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            
        </div>
    </section>
</div>
