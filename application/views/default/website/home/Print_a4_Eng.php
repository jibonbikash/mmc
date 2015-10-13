<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            .tablesorter{
                font-size:16px; 
                text-align:left;
                font-family:Tahoma, Geneva, sans-serif;
            }
            table tr thead th{
                background-color: #FAFAFA;
                border: 1px #D9D9D9 solid;
                font-size: 12px;
                font-family: sans-serif;
            }
            table tr td{
                border: 1px #D9D9D9 solid;
                font-size: 11px;
                font-family: sans-serif;
            }
            table{
                border-spacing: 0;
            }
        </style>              

    </head>
    <body style="margin-left: 10px; margin-right: 10px;" bgcolor="#ffffff">
        <table cellpadding="0" cellspacing="0" width="780" border="0" align="left">
            <tr>
                <td valign="top" align="left">
                    <script language="javascript">
                        <!--
                        window.onerror = scripterror;				
                        function scripterror()
                        {
                            return true;
                        }
                        varele1=window.opener.document.getElementById("<?php echo $this->uri->segment(3); ?>");
                        text=varele1.innerHTML;
                        document.write(text);
                        text=document;
                        print(text);
                        //-->
                    </script>
                </td>
            </tr>			
        </table>
        <script>
            $("#ReportTable").attr("border","1");
            $("#ReportTable").attr("cellpadding","3");
            $("#ReportTable").attr("cellspacing","0");
            $("#ReportTable").attr("style","border-collapse: collapse");
            $("#ReportTable tr").attr("style","display: show");
        </script>        
    </body>
</html>