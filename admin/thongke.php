<div class="container mt-3">
    <p id="text-date"></p>
    <select name="" id="" class="select-date">
        <option value="7ngay">7 ngay qua</option>
        <option value="28ngay">28 ngay qua</option>
        <option value="90ngay">90 ngay qua</option>
        <option value="365ngay">365 ngay qua</option>
    </select>
    <div id="myfirstchart" style="height: 250px;"></div>
</div>
<script>
    $(document).ready(function(){    
        thongke();
        var char = new Morris.Bar({
        element: 'myfirstchart',

        xkey: 'date',
        ykeys: ['donhang','doanhthu','soluongbanra'],
    
        labels: ['Don hang','Doanh thu','So luong ban ra']
        });

        $('.select-date').change(function() {
            var thoigian = $(this).val();
            if(thoigian == '7ngay') {
                var text = '7 ngay qua';
                console.log('7');
            }
            else if(thoigian == '28ngay') {
                var text = '28 ngay qua';
            }
            else if(thoigian == '90ngay') {
                var text = '90 ngay qua';
            }
            else if(thoigian == '365ngay') {
                var text = '365 ngay qua';
            }
            $.ajax({
                url: "http://localhost/webdienmay2/admin/xulythongke.php",       
                method:"post",      
                dataType:'json', 
                data:{thoigian:thoigian},
                success: function(data){     
                    $('#text-date').text(text);
                    char.setData(data);
                }
            });
        })

        function thongke() {
            var text = '';
            // $('#text-date').text(text);
            
            $.ajax({
                url: "http://localhost/webdienmay2/admin/xulythongke.php",       
                method:"post",      
                dataType:'json', 
                success: function(data){     
                    $('#text-date').text(text);
                    char.setData(data);
                }
            });
        }
        
    });
</script>
