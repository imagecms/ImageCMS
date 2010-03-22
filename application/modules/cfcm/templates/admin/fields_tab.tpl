    <h4>Доп. Поля</h4>
	<div style="padding:8px;" id="cfcm_fields_block"></div>

    {literal}
    <script type="text/javascript">
           $("category_selectbox").addEvent("change", function(event){
            category_id = $("category_selectbox").value;
            ajax_div('cfcm_fields_block',  base_url + "admin/components/cp/cfcm/form_from_category_group/" + category_id);
           });

            // Load current category fields
            window.addEvent('domready', function(){
                category_id = $("category_selectbox").value;
                ajax_div('cfcm_fields_block',  base_url + "admin/components/cp/cfcm/form_from_category_group/" + category_id); 
            });
    </script>
    {/literal}
