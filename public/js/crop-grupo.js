
        
        $( "#buscarImagen" ).click(function() {
            console.log('hola');
            document.getElementById('image').click();
        });
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $( "#btnsUp" ).css("display","none");
        $( "#upload-normal" ).css("display","block");
        $( "#upload-crop" ).css("display","none");
        let isNormal    = true;
        let tempNormal  = '';
        let tempCrop    = '';
        
        $( "#cut" ).click(function() {
            if( isNormal ){
                $( "#cut" ).text( "NORMAL" );
                $( "#upload-normal" ).css("display","none");
                $( "#upload-crop" ).css("display","block");
                resize.croppie('bind', tempCrop);
            }else{
                $( "#cut" ).text( "RECORTAR" );
                $( "#upload-normal" ).css("display","block");
                $( "#upload-crop" ).css("display","none");
            }
            isNormal = !isNormal;
        });

        let loadFile = function(event) {
            const titleAlert = "IMAGEN";
            const file = event.target.files[0];
            this.imgTemp = event.target.files[0];
            const type = file.type;
            const size = file.size;
            
            if ( !((type == 'image/jpeg') || (type == 'image/jpg') || (type == 'image/png')) ) {
                Swal.fire({
                    title: titleAlert,
                    text: "FORMATOS SOPORTADOS PNG O JPG",
                    icon: 'error',
                    confirmButtonColor: '#0275d8',
                    allowOutsideClick: false
                });
                return;
            }
            if( (size / 1024) > 1024 ){
                Swal.fire({
                    title: titleAlert,
                    text: "PESO MÁXIMO DE 1 MB SUPERADO",
                    icon: 'error',
                    confirmButtonColor: '#0275d8',
                    allowOutsideClick: false
                });
                return;
            }            
            
            $( "#btnsUp" ).css("display","block");
            var output = document.getElementById('upload-normal');
            $( "#upload-normal" ).addClass( ["img-thumbnail"] ).css({"width": "360", "margin-left": "auto", "margin-right": "auto"});
            const reader = new FileReader()
            const self = this
            reader.onload = function (e) {
                tempNormal = e.target.result;
            }
            reader.readAsDataURL(file);
            output.src = URL.createObjectURL(file);
            
        };
        
        let resize = $('#upload-crop').croppie({
            enableExif: true,
            enableOrientation: true,
            showZoomer: true,
            enforceBoundary: false,
            viewport: {
                width: 330,
                height: 330,
                type: 'square'
            },
            boundary: {
                width: 360,
                height: 360
            }
        });
        
        $('#image').on('change', function () { 
            var reader = new FileReader();
            reader.onload = function (e) {
                tempCrop = e.target.result;
                resize.croppie('bind',{
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });
        
        
        $('.upload-image').on('click', function (ev) {
            Swal.showLoading();
            resize.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (img) {
                $.ajax({
                url: "{{route('empresa.uploadimage')}}",
                type: "POST",
                data: {"imageNormal":tempNormal, "imageCrop":img, "isNormal":isNormal},
                    success: function (data) {
                        window.location.href = data.url;
                        Swal.close();
                    }
                });
            });
            
        });