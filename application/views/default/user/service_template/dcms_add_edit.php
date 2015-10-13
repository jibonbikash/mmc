<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI=& get_instance();

//print_r($services);
?>

<div id="system_sidebar_left" class="system_sidebar_left col-sm-1" style="padding-left:0;">&nbsp;</div>
<div id="system_content">
    <div class="clearfix"></div>
    <div class="grid_10" >
        <div class="box round first">
            <h2><?php echo $this->lang->line('PROTIBEDON_TEMPLATE')?></h2>
            <div class="block ">
                <form action="<?php echo $CI->get_encoded_url('user/service_template/index/save') ?>" class="signup" id="form_id" method="post" accept-charset="utf-8">
                    <table id="adding_elements" width="100%">
                        <thead>
                            <tr>
                                <th class="labelcell"><span class="fieldcell"><?php echo $this->lang->line('PROTIBEDONER_TARIKH')?></span><span style="color: red;">*</span></th>
                                <th class="fieldcell"><input name="report_date" id="report_date" class="report_date selectbox-1 validate[required] report_date" type="text"/></th>
                            </tr>
                            <tr>
                                <th class="labelcell"><?php echo $this->lang->line('CUSTOMER_NAME');?><span style="color: red;">*</span></th>
                                <th class="labelcell"><?php echo $this->lang->line('MALE_FEMALE');?><span style="color: red;">*</span></th>
                                <th class="labelcell"><?php echo $this->lang->line('SERVICE_NAME');?><span style="color: red;">*</span></th>
                                <th class="labelcell"><?php echo $this->lang->line('MONEY_EARNED_FROM_SERVICE');?><span style="color: red;">*</span></th>
                                <th class="labelcell"><?php echo $this->lang->line('DELETE');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="supliments_1">
                                <th class="fieldcell">
                                    <div class="input text">
                                        <input name="customer_name[]" id="customer_name" class="validate[required]" type="text"/>
                                    </div>
                                </th>

                                <th class="fieldcell">
                                    <div class="input select">
                                        <select name="customer_gender[]" id="customer_gender" class="selectbox-1 validate[required]">
                                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                            <option value="<?php echo $this->lang->line('MALE_VAL')?>"><?php echo $this->lang->line('MALE');?></option>
                                            <option value="<?php echo $this->lang->line('FEMALE_VAL')?>"><?php echo $this->lang->line('FEMALE');?></option>
                                        </select>
                                    </div>
                                </th>

                                <th class="fieldcell">
                                    <div class="input select">
                                        <select name="service_sername[]" id="service_sername" class="selectbox-1 validate[required]">
                                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                            <?php
                                            foreach($services as $service)
                                            {
                                            ?>
                                                <option value="<?php echo $service['service_id']?>"><?php echo $service['service_name'];?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </th>

                                <th class="fieldcell">
                                    <div class="input text">
                                        <input name="service_earning[]" id="service_earning" class="validate[number]" type="text"/>
                                    </div>
                                </th>

                                <th class="labelcell">
                                    <input type="button" style="cursor:pointer;" id="1" class="myButton submit delete" name="delete" value="<?php echo $this->lang->line('DELETE');?>" />
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <br/>
                    <table>
                        <tr class="add" id="add_more_1">
                            <th class="labelcell">
                                <input type="button" style="cursor:pointer;" id="1" class="myButton submit add_more" name="1" onclick="RowIncrement()" value="<?php echo $this->lang->line('ADD_MORE');?>" />
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <input  class="myButton" name="submit" type="submit" value="<?php echo $this->lang->line('SAVE');?>"/>
                                <input  type="reset" class="myButton" value="<?php echo $this->lang->line('DISCARD');?>"/>
                            </th>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div class="box round first grid">
            <table>
                <tr>
                    <td>
                        <div id="upload">
                            <div class="upload1">
                                <a class="external" onclick="return confirm('<?php echo $this->lang->line('DO_YOU_WANT_TO_DOWNLOAD');?>')" href="<?php echo $CI->get_encoded_url('user/excel_download') ?>" title="<?php echo $this->lang->line('DOWNLOAD_EXCEL_TEMPLATE');?>"><img src="<?php echo base_url()?>images/download-icon.png" alt="<?php echo $this->lang->line('DOWNLOAD_EXCEL_TEMPLATE');?>" /></a>
                            </div>
                            <div class="upload2">
                                <?php echo $this->lang->line('DOWNLOAD_EXCEL_TEMPLATE');?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form id="uploadclick" action="<?php echo $CI->get_encoded_url('user/service_template/upload_excel_file') ?>" id="uisc_user_report_forms" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <div class="input file">
                            <input type="file" name="file"  class="validate[required]" id="file" style=""/>
                        </div>
                    </td>
                    <td>
                        <div class="">
                            <input id="upload_button" type="image" title="<?php echo $this->lang->line('UPLOAD_EXCEL_TEMPLATE');?>"  src="<?php echo base_url()?>images/upload-icon.png" />
                        </div>
                        <div class="download2" style=""><?php echo $this->lang->line('UPLOAD_EXCEL_TEMPLATE');?></div>
                        </form>
                        </td>
                    </td>
                </tr>
            </table>
        </div>

    </div>

    <div class="clear">
    </div>
    <div style="line-height:15px;">&nbsp;</div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        turn_off_triggers();
        $( ".report_date" ).datepicker({dateFormat : display_date_format});


        $(document).on("click","#upload_button",function()
        {
            $("#uploadclick").submit();
        });
    });

    var ExId = 0;
    function RowIncrement()
    {
        var table = document.getElementById('adding_elements');

        var rowCount = table.rows.length;
        //alert(rowCount);
        var row = table.insertRow(rowCount);
        row.id = "T" + ExId;
        row.className = "tableHover";
        //alert(row.id);
        var cell1 = row.insertCell(0);
        cell1.innerHTML = "<input type='text' name='customer_name[]' id='customer_name" + ExId + "' class='form-control'/>\n\
        <input type='hidden' id='task_id[]' name='task_id[]' value=''/>";
        var cell1 = row.insertCell(1);
        cell1.innerHTML = "<select name='customer_gender[]' id='customer_gender" + ExId + "' class='selectbox-1'>\n\
        <option value=''><?php echo $this->lang->line('SELECT');?></option><option value='<?php echo $this->lang->line('MALE_VAL')?>'><?php echo $this->lang->line('MALE');?></option><option value='<?php echo $this->lang->line('FEMALE_VAL');?>'><?php echo $this->lang->line('FEMALE');?></option></select>";
        var cell1 = row.insertCell(2);
        cell1.innerHTML = "<select name='service_sername[]' id='service_sername" + ExId + "' class='selectbox-1'>\n\
        <option value=''><?php echo $this->lang->line('SELECT');?></option>\n\
        <?php
        foreach ($services as $service_list)
            echo "<option value='" . $service_list['service_id']. "'>" . $service_list['service_name'] . "</option>";
        ?>";
        var cell1 = row.insertCell(3);
        cell1.innerHTML = "<input type='text' name='service_earning[]' id='service_earning" + ExId + "' class='form-control'/>\n\
        <input type='hidden' id='task_id[]' name='task_id[]' value=''/>\n\
        <input type='hidden' id='elmIndex[]' name='elmIndex[]' value='" + ExId + "'/>";
        cell1.style.cursor = "default";
        cell1 = row.insertCell(4);
        cell1.innerHTML = "<a class='external delete submit myButton' data-original-title='' onclick=\"RowDecrement('adding_elements','T" + ExId + "')\">\n\
        <?php echo $this->lang->line('DELETE');?> </a>";
        cell1.style.cursor = "default";
        document.getElementById("customer_name" + ExId).focus();
        ExId = ExId + 1;
    }

    function RowDecrement(adding_elements, id)
    {
        try {
            var table = document.getElementById(adding_elements);
            for (var i = 1; i < table.rows.length; i++)
            {
                if (table.rows[i].id == id)
                {
                    table.deleteRow(i);
                }
            }
        }
        catch (e) {
            alert(e);
        }
    }
    </script>

<script>
    function myFunction() {
        location.reload();
    }
</script>