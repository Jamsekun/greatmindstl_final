@extends('layouts.admin.main')

@push('css')
<style type="text/css">
.k-avatar {
    position: relative;
    display: inline-block;
}
.k-avatar .k-avatar__holder {
    width: 120px;
    height: 120px;
    border-radius: 3px;
    background-repeat: no-repeat;
    background-size: contain;
}
.k-avatar .k-avatar__upload {
    cursor: pointer;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    position: absolute;
    right: -10px;
    top: -10px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #ffffff;
    -webkit-box-shadow: 0px 0px 13px 0px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 13px 0px rgba(0, 0, 0, 0.1);
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
}
.k-avatar .k-avatar__upload input {
    width: 0 !important;
    height: 0 !important;
    overflow: hidden;
    opacity: 0;
}
.k-avatar .k-avatar__upload i {
    color: #385aeb;
    font-size: 0.9rem;
}
.k-avatar .k-avatar__upload:hover {
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
    background-color: #385aeb;
}
.k-avatar .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar .k-avatar__cancel {
    cursor: pointer;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    position: absolute;
    top: auto;
    right: -10px;
    bottom: -5px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background-color: #ffffff;
    -webkit-box-shadow: 0px 0px 13px 0px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 13px 0px rgba(0, 0, 0, 0.1);
    display: none;
}
.k-avatar .k-avatar__cancel i {
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
    color: #a1a8c3;
    font-size: 0.9rem;
}
.k-avatar .k-avatar__cancel:hover i {
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
    color: #385aeb;
}
.k-avatar.k-avatar--changed .k-avatar__cancel {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}
.k-avatar.k-avatar--brand .k-avatar__upload i {
    color: #385aeb;
}
.k-avatar.k-avatar--brand .k-avatar__upload:hover {
    background-color: #385aeb;
}
.k-avatar.k-avatar--brand .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--metal .k-avatar__upload i {
    color: #d3dae6;
}
.k-avatar.k-avatar--metal .k-avatar__upload:hover {
    background-color: #d3dae6;
}
.k-avatar.k-avatar--metal .k-avatar__upload:hover i {
    color: #586272;
}
.k-avatar.k-avatar--light .k-avatar__upload i {
    color: #ffffff;
}
.k-avatar.k-avatar--light .k-avatar__upload:hover {
    background-color: #ffffff;
}
.k-avatar.k-avatar--light .k-avatar__upload:hover i {
    color: #282a3c;
}
.k-avatar.k-avatar--dark .k-avatar__upload i {
    color: #645ca1;
}
.k-avatar.k-avatar--dark .k-avatar__upload:hover {
    background-color: #645ca1;
}
.k-avatar.k-avatar--dark .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--accent .k-avatar__upload i {
    color: #00c5dc;
}
.k-avatar.k-avatar--accent .k-avatar__upload:hover {
    background-color: #00c5dc;
}
.k-avatar.k-avatar--accent .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--focus .k-avatar__upload i {
    color: #9816f4;
}
.k-avatar.k-avatar--focus .k-avatar__upload:hover {
    background-color: #9816f4;
}
.k-avatar.k-avatar--focus .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--primary .k-avatar__upload i {
    color: #5867dd;
}
.k-avatar.k-avatar--primary .k-avatar__upload:hover {
    background-color: #5867dd;
}
.k-avatar.k-avatar--primary .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--success .k-avatar__upload i {
    color: #1dc9b7;
}
.k-avatar.k-avatar--success .k-avatar__upload:hover {
    background-color: #1dc9b7;
}
.k-avatar.k-avatar--success .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--info .k-avatar__upload i {
    color: #5578eb;
}
.k-avatar.k-avatar--info .k-avatar__upload:hover {
    background-color: #5578eb;
}
.k-avatar.k-avatar--info .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--warning .k-avatar__upload i {
    color: #ffb822;
}
.k-avatar.k-avatar--warning .k-avatar__upload:hover {
    background-color: #ffb822;
}
.k-avatar.k-avatar--warning .k-avatar__upload:hover i {
    color: #111111;
}
.k-avatar.k-avatar--danger .k-avatar__upload i {
    color: #fd397a;
}
.k-avatar.k-avatar--danger .k-avatar__upload:hover {
    background-color: #fd397a;
}
.k-avatar.k-avatar--danger .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--circle .k-avatar__holder {
    border-radius: 50%;
}
.k-avatar.k-avatar--circle .k-avatar__upload {
    right: 0px;
    top: 5px;
}
.k-avatar.k-avatar--circle .k-avatar__cancel {
    right: 3px;
    bottom: 10px;
}
.k-avatar.k-avatar--outline .k-avatar__holder {
    border: 3px solid #ffffff;
    -webkit-box-shadow: 0px 0px 13px 0px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 13px 0px rgba(0, 0, 0, 0.1);
}


</style>
@endpush

@section('page-head')
<div id="page-title">
    <h1 class="page-header text-overflow">Manage Employees</h1>
</div>

<ol class="breadcrumb">
	<li>
		<a href="{{ route('admin.index') }}">
			<i class="demo-pli-home"></i>
			Home
		</a>
	</li>
	<li>Employee List</li>
	<li class="active">Employee Information</li>
</ol>
@endsection

@section('content')
<!---------------------------------->
<div class="row pad-btm">
    <div class="col-sm-6 toolbar-left">
        <a href="{{ route('admin.agents.index') }}" class="btn btn-purple">Back</a>
    </div>
</div>
<!---------------------------------->
<div class="row">
	<div class="col-sm-4 col-md-3">

        <div class="modal fade" id="modal-qr_code" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!--Modal header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title">QR CODE</h4>
                </div>

                <!--Modal body-->
                <div class="modal-body">
                    <canvas width="640" height="600" class="hidden"></canvas>

                    <p class="text-semibold text-main text-center">
                        {!! QR::size(300)->generate("http://greatmindstl.com/agent/{$model->employee_number}") !!}
                    </p>
                </div>

                <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-primary" id="btn-download_qr">Download</button>
                </div>
            </div>
        </div>
    </div>
        <!---------------------------------->
        <div class="panel pos-rel">
            <div class="widget-control text-right">
                <div class="btn-group dropdown">
                    <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right" style="">
                        <li><a href="#"><i class="icon-lg icon-fw demo-psi-pen-5"></i> Edit</a></li>
                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-mail"></i> Send a Message</a></li>
                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-calendar-4"></i> View Details</a></li>
                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-lock-user"></i> Lock</a></li>
                    </ul>
                </div>
            </div>
            <div class="pad-all">
                <div class="media pad-ver">
                    <div class="media-left">
                        <a href="#" class="box-inline">
                            @if (is_null($model->picture))
                                <img alt="Profile Picture" class="img-md img-circle" src="{{ asset('assets/image/user/default.jpg') }}">
                            @else
                                <img alt="Profile Picture" class="img-md img-circle" src="{{ $model->picture }}">
                            @endif
                        </a>
                    </div>
                    <div class="media-body pad-top">
                        <a href="#" class="box-inline">
                            <span class="text-lg text-semibold text-main">{{ $model->full_name }}</span>
                            <p class="text-sm">{{ $model->position }}</p>
                        </a>
                    </div>
                </div>
             <div class="text-center pad-to">
    <div class="btn-group">
        <!-- QR Code Button (Unchanged) -->
        <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-qr_code">
            <i class="fa fa-qrcode"></i> QR CODE
        </a>

        <!-- Generate ID Button (Now Triggers ID Modal) -->
        <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-generate_id">
            <i class="fa fa-file-image-o"></i> GENERATE ID
        </a>
    </div>
</div>
<!-- Generate ID Modal -->
<div class="modal fade" id="modal-generate_id" role="dialog" tabindex="-1" aria-labelledby="generate-id-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center">
            

                <div style="position: relative; display: inline-block;">
                    <img id="id-template-image-front" src="{{ asset('assets/image/stl/templatefrontfinal.jpg') }}" alt="ID Template Front" style="max-width: 100%; height: auto;">
                    <img id="profile-picture-overlay" src="" alt="Profile Picture" style="position: absolute; top: 235px; left: 167px; width: 305px; height: 260px; display: none;">
                    <span id="employee-name-overlay" style="position: absolute; top: 513px; left: 50%; transform: translateX(-50%); text-align: center; font-size: 30px; font-weight: bold; color: black; display: none; white-space: nowrap;"></span>
                    <div class="shape" style="position: absolute; bottom: 10px; left: 22px; width: 570px; height: 48px; background-color: white;"></div>
                    <span id="employee-position-front-overlay" style="position: absolute; bottom: 13px; left: 50%; transform: translateX(-50%); text-align: center; font-size: 35px; font-weight: bold; color: black; display: none; white-space: nowrap;"></span>
                    <div class="field-coordinator-shape-front" style="position: absolute; top: 200px; left: 167px; width: 305px; height: 30px; background-color: gray;"></div>
                    <span id="employee-number-front-overlay" style="position: absolute; top: 200px; left: 50%; transform: translateX(-50%); text-align: center; font-size: 20px; font-weight: bold; color: black; display: none; white-space: nowrap;"></span>
                </div>

                <div style="position: relative; display: inline-block; margin--right: 20px;">
                    <img id="id-template-image-back" src="{{ asset('assets/image/stl/templateback.jpg') }}" alt="ID Template Back" style="max-width: 100%; height: auto;">
                    <div class="field-coordinator-shape-back" style="position: absolute; top: 215px; left: 200px; width: 220px; height: 40px; background-color: gray;"></div>
                    <span id="employee-number-back-overlay" style="position: absolute; top: 225px; left: 50%; transform: translateX(-50%); text-align: center; font-size: 16px; font-weight: bold; color: black; display: none;"></span>
                    <span id="employee-address-overlay" style="position: absolute; bottom: 235px; left: 60%; transform: translateX(-50%); text-align: center; font-size: 12px; font-weight: bold; color: black; display: none;"></span>
                    <img id="qr-code-overlay" src="" alt="QR Code" style="position: absolute; top: 24px; left: 200px; width: 220px; height: 180px; display: none;">
                </div>
            </div>

            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <a id="download-id-image" href="#" class="btn btn-primary">
                    <i class="fa fa-file-pdf-o"></i> Download ID
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    let isDownloadClicked = false;
    let employeeNumberValue = "{{ $model->employee_number }}";

    $('#download-id-image').on('click', function(e) {
        e.preventDefault();
        isDownloadClicked = true;
        captureImage();
    });

    $('#modal-generate_id').on('shown.bs.modal', function () {
        console.log("Modal shown, isDownloadClicked:", isDownloadClicked);

        var profilePictureUrl = "{{ $model->picture }}";
        var employeePosition = "{{ $model->position }}";
        var employeeAddress = "{{ $model->address }}";
        var qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=" + encodeURIComponent("http://greatmindstl.com/agent/{{ $model->employee_number }}");
        var fieldCoordinator = "{{ $model->field_coordinator }}";
        var colorMap = {
            'TISAY': 'red',
            'JOSIE': 'blue',
            'POGIE': 'yellow',
            'BOY AROJADO': 'green',
            'BOY-GIE': 'pink',
            'SAMBOY': 'magenta',
            'EMILITA SORIANO': 'gray',
            'LANDO': 'orange',
            'RO': 'brown',
            'ROMMEL': 'white'
        };
        var positionColor = colorMap[fieldCoordinator] || 'grey';
        var employeeName = "{{ $model->full_name }}";

        var displayPosition = employeePosition;
        if (employeePosition) {
            if (employeePosition.toLowerCase() === "kabo") {
                displayPosition = "SALES SUPERVISOR";
            } else if (employeePosition.toLowerCase() === "kubrador") {
                displayPosition = "SALES REPRESENTATIVE";
            }
        }

        // Back Template Setup
        $('#profile-picture-overlay').attr('src', profilePictureUrl || "{{ asset('assets/image/user/default.jpg') }}").show();
        $('#employee-number-back-overlay').text("ID NO. " + employeeNumberValue).show();
        $('#employee-address-overlay').text(employeeAddress).show();
        $('.field-coordinator-shape-back').css('background-color', positionColor);
        $('#employee-position-overlay').text(displayPosition).show();

        var qrCodeImage = new Image();
        qrCodeImage.crossOrigin = "anonymous";
        qrCodeImage.onload = function () {
            $('#qr-code-overlay').attr('src', qrCodeImage.src).show();
            console.log("QR code loaded");
            setTimeout(captureImage, 200);
        };
        qrCodeImage.onerror = function () {
            console.error("Failed to load QR code image.");
            console.log("QR code error");
            setTimeout(captureImage, 500);
        };
        qrCodeImage.src = qrCodeUrl;

        // Front Template Setup
        $('#profile-picture-overlay').attr('src', profilePictureUrl || "{{ asset('assets/image/user/default.jpg') }}").show();
        $('#employee-name-overlay').text(employeeName).show();
        $('#employee-position-front-overlay').text(displayPosition).show();
        $('#employee-number-front-overlay').text(employeeNumberValue).show();
        $('.field-coordinator-shape-front').css('background-color', positionColor);
    });

function captureImage() {
    console.log("captureImage() called, isDownloadClicked:", isDownloadClicked);
    if (!isDownloadClicked) {
        return;
    }

    html2canvas(document.querySelector("#modal-generate_id .modal-body > div:first-child"), {
        useCORS: true,
    }).then(canvasFront => {
        let imgDataFront = canvasFront.toDataURL("image/jpeg");

        html2canvas(document.querySelector("#modal-generate_id .modal-body > div:last-child"), {
            useCORS: true
        }).then(canvasBack => {
            let imgDataBack = canvasBack.toDataURL("image/jpeg");

            let pdfWidth = 595; // Full A4 width
            let pdfHeight = 842; // Full A4 height
            let contentHeight = 360; // 5 inches height in points (5 * 72)
            let marginTop = 36; // 0.5 inch margin in points (0.5 * 72)

            let pdf = new jspdf.jsPDF({
                orientation: 'p',
                unit: 'pt',
                format: [pdfWidth, pdfHeight]
            });

            // Calculate positions and scaled widths for side-by-side placement
            let frontX = 0;
            let backX = pdfWidth / 2; // Place back at the middle of the PDF width
            let scaledWidth = pdfWidth / 2; // Scale to fit half of the PDF width

            // Add images to the top half of the PDF, scaled to fit, with margin
            pdf.addImage(imgDataFront, 'JPEG', frontX, marginTop, scaledWidth, contentHeight);
            pdf.addImage(imgDataBack, 'JPEG', backX, marginTop, scaledWidth, contentHeight);

            // Add a vertical line in the middle as a folding guide (only on the ID card portion)
            pdf.setLineWidth(1); // Set line width (adjust as needed)
            pdf.line(pdfWidth / 2, marginTop, pdfWidth / 2, contentHeight + marginTop); // Draw the line to the content height with margin

            // Add a border around the ID card area with margin
            pdf.rect(0, marginTop, pdfWidth, contentHeight, 'S'); // 'S' means stroke (outline) the rectangle

            pdf.save(employeeNumberValue + ".pdf");

            console.log("jsPDF done");

        }).catch(errorBack => {
            console.error("Error capturing back image:", errorBack);
        });

    }).catch(errorFront => {
        console.error("Error capturing front image:", errorFront);
    });
}
    $('#modal-generate_id').on('hidden.bs.modal', function () {
        $('#profile-picture-overlay').hide().attr('src', '');
        $('#employee-position-overlay').hide().text('');
        $('#employee-address-overlay').hide().text('');
        $('#qr-code-overlay').hide().attr('src', '');
        $('.field-coordinator-shape').css('background-color', 'gray');
        $('#employee-name-overlay').hide().text('');
        $('#employee-position-front-overlay').hide().text('');
        $('#employee-number-overlay').hide().text('');
        isDownloadClicked = false;
    });
</script>


            </div>
        </div>
        <!---------------------------------->
	</div>

	<div class="col-sm-8 col-md-9">
        <div id="alert-message">
            
        </div>

		<div class="panel panel-primary">
            <!--Panel heading-->
            <div class="panel-heading">
                <div class="panel-control">

                    <!--Nav tabs-->
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1">Personal Information</a></li>
                    </ul>

                </div>
                <h3 class="panel-title">&nbsp;</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade in active">
                        <form class="form-horizontal" id="form-account_information" method="POST" action="{{ route('admin.agents.update', $model->id) }}" enctype="multipart/form-data">
                            @csrf

                <p class="text-main text-bold">Profile Picture</p>
<hr>

<div class="form-group">
    <label class="col-md-2 control-label">Avatar & Signature</label>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-6">
                <div class="k-avatar k-avatar--outline k-avatar--circle" id="k_profile_avatar">
                    @if (is_null($model->picture))
                        <div class="k-avatar__holder" style="background-image: url('{{ asset('assets/image/user/default.jpg') }}');"></div>
                    @else
                        <div class="k-avatar__holder" style="background-image: url('{{ $model->picture }}');"></div>
                    @endif

                    <label class="k-avatar__upload" data-toggle="k-tooltip" title="" data-original-title="Change avatar">
                        <i class="fa fa-pencil"></i>
                        <input type="file" name="picture">
                    </label>
                    <span class="k-avatar__cancel" data-toggle="k-tooltip" title="" data-original-title="Cancel avatar">
                        <i class="fa fa-times"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                @if ($model->signature)
                    <img src="{{ $model->signature }}" alt="Signature" style="max-width: 200px;">
                @else
                    <p>No signature uploaded.</p>
                @endif
                <input type="file" name="signature" accept="image/jpeg, image/png">
            </div>
        </div>
        
        
    </div>
</div>

                            <p class="text-main text-bold">Company Information</p>
                            <hr>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">ID No.</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="employee_number" value="{{ $model->employee_number }}">
                                </div>
                            </div>

                          <div class="form-group">
    <label class="col-sm-2 control-label">Position</label>
    <div class="col-sm-6">
        <select name="position" class="form-control">
            <option></option> 
            @php
                $positions = [
                    'SALES REPRESENTATIVE',
                    'SALES SUPERVISOR',
                    'FIELD COORDINATOR',
                    'OPERATION MANAGER',
                    'ASST. OPERATION MANAGER',
                    'IT MANAGER',
                    'HEAD CASHIER',
                    'TABLE MANAGER',
                    'ADMIN STAFF',
                    'FINANCE MANAGER',
                    'ADMIN MANAGER',
                ];
            @endphp

            @foreach ($positions as $positionOption)
                <option value="{{ $positionOption }}" {{ $positionOption == $model->position ? 'selected' : '' }}>
                    {{ $positionOption }}
                </option>
            @endforeach
        </select>
    </div>
</div>

 <div class="form-group">
    <label class="col-sm-2 control-label">Station</label>
    <div class="col-sm-6">
        <select name="station" class="form-control">
            <option></option>

            @foreach (['BAYANAN STATION', 'TUNASAN STATION', 'NHA STATION', 'SUCAT STATION', 'ADMIN OFFICE'] as $station)
                <option value="{{ $station }}" {{ isset($model) && $station == $model->station ? 'selected' : '' }}>
                    {{ $station }}
                </option>
            @endforeach
        </select>
    </div>
</div>         

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Field Coordinator</label>
                                <div class="col-sm-6">
                                    <select name="field_coordinator" id="" class="form-control">
                                        <option></option>

                                        @php
                                            $field_coordinators = \App\Models\FieldCoordinator::get();
                                        @endphp

                                        @foreach ($field_coordinators as $field_coordinator)
                                            <option value="{{ $field_coordinator->value }}" {{ $field_coordinator->value == $model->field_coordinator ? 'selected' : '' }}>{{ $field_coordinator->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Field Supervisor</label>
                                <div class="col-sm-6">
                                    <input type="text" name="field_supervisor" class="form-control text-uppercase" value="{{ $model->field_supervisor }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status" class="form-control">
                                        <option></option>
                                        <option value="Active" {{ $model->status == 'Active' ? 'selected': '' }}>Active</option>
                                        <option value="Inactive" {{ $model->status == 'Inactive' ? 'selected': '' }}>Inactive</option>
                                        <option value="Lost ID" {{ $model->status == 'Lost ID' ? 'selected': '' }}>Lost ID</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Remarks</label>
                                <div class="col-sm-6">
                                    <input type="text" name="remarks" class="form-control text-uppercase" value="{{ $model->remarks }}">
                                </div>
                            </div>
                            
                        
                            
                  <div class="form-group">
                                <label class="col-sm-2 control-label">Date Hired</label>
                                <div class="col-sm-6">
                                    <input type="date" name="date_hired" class="form-control" value="{{ optional($model->created_at)->toDateString() }}" readonly>
                                </div>
                            </div>

                            <p class="text-main text-bold">Personal Information</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">First name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="first_name" value="{{ $model->first_name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Middle name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="middle_name" value="{{ trim(str_replace('.', '', $model->middle_name)) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Last name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="last_name" value="{{ $model->last_name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Suffix</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="suffix" value="{{ $model->suffix }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nickname</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="nick_name" value="{{ $model->nick_name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Birthday</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="birthday" data-input="datepicker" value="{{ $model->birthday }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Gender</label>
                                <div class="col-sm-6">
                                    <select name="gender" class="form-control">
                                        <option value="M" {{ $model->gender == 'M' ? 'selected': '' }}>M</option>
                                        <option value="F" {{ $model->gender == 'F' ? 'selected': '' }}>F</option>
                                        <!--option value=""></option-->
                                        <!--option value="M">M</option-->
                                        <!--option value="F">F</option-->
                                    </select>
                                </div>
                            </div>

                            <p class="text-main text-bold">Contact Information</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Telephone No.</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="telephone_number" value="{{ $model->telephone_number }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Phone No.</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="phone_number" value="{{ $model->phone_number }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="email" value="{{ $model->email == 'None' ? '' : $model->email }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="address" value="{{ $model->address }}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-2 pull-right">
                        <button type="button" id="btn-update_agent" class="btn btn-default btn-block">Save</button>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

@endsection

@push('js')
<script type="text/javascript">
$(function (namespace, $) {
    'use strict';

    var js = function () {
        var o = this;

        $(document).ready(function () {
            o.initialize()
        })
    }

    var p = js.prototype;

    p.initialize = function () {
        this._QR();
        this._Avatar();
        this._Datepicker();
        this._validate();
    }

    p._QR = function () {
        $('#btn-download_qr').click(function () {
            axios({
                method: 'POST',
                url: '{{ route('admin.agents.qr_code', $model->id) }}',
            }).then(function (response) {
                var data = response.data;

                var canvas = document.querySelector("canvas"),
                context = canvas.getContext("2d");

                var image = new Image;
                image.src = data.url;
                image.onload = function() {
                    context.drawImage(image, 0, 0, 300, 300);

                    var a = $('<a>', {
                        class: 'hidden',
                    })
                    .attr('href', canvas.toDataURL("image/png"))
                    .attr('download', data.title + '.png')
                    .appendTo($('body'));

                    a[0].click();
                    a.remove();
                }
            });
        })
    }

    p._Avatar = function () {
        var KAvatar = function(elementId, options) {
            // Main object
            var the = this;
            var init = false;

            // Get element object
            var element = $(elementId);

            if (!element) {
                return; 
            }


            var defaultOptions = {
            };

            var Plugin = {
                construct: function(options) {
                    Plugin.init(options);
                    Plugin.build();

                    return the;
                },

                init: function(options) {
                    the.element = element;
                    the.events = [];

                    the.input = element.find('input[type="file"]');

                    the.holder = element.find('.k-avatar__holder');
                    the.cancel = element.find('.k-avatar__cancel');
                    the.src = $(the.holder).css('backgroundImage');

                    the.options = $.extend({}, defaultOptions, options);
                },

                /**
                 * Build Form Wizard
                 */
                build: function() {
                    // Handle avatar change
                    $(the.input).on('change', function(e) {
                        e.preventDefault();

                      if (e.target.files && e.target.files[0]) {
                          var reader = new FileReader();

                          reader.onload = function(e) {
                              $(the.holder).css('background-image', 'url('+e.target.result +')')
                          }

                          reader.readAsDataURL(e.target.files[0]);

                          $(the.element).addClass('k-avatar--changed')
                      }
                    });

                    $(the.cancel).on('click', function(e) {
                        e.preventDefault();

                        $(the.element).removeClass('k-avatar--changed');
                        $(the.holder).css('background-image', the.src);

                        the.input.value = "";
                    });
                },

                /**
                 * Trigger events
                 */
                eventTrigger: function(name) {
                    //KUtil.triggerCustomEvent(name);
                    for (var i = 0; i < the.events.length; i++) {
                        var event = the.events[i];
                        if (event.name == name) {
                            if (event.one == true) {
                                if (event.fired == false) {
                                    the.events[i].fired = true;
                                    event.handler.call(this, the);
                                }
                            } else {
                                event.handler.call(this, the);
                            }
                        }
                    }
                },

                addEvent: function(name, handler, one) {
                    the.events.push({
                        name: name,
                        handler: handler,
                        one: one,
                        fired: false
                    });

                    return the;
                }
            };

            the.setDefaults = function(options) {
                defaultOptions = options;
            };

            the.on = function(name, handler) {
                return Plugin.addEvent(name, handler);
            };

            the.one = function(name, handler) {
                return Plugin.addEvent(name, handler, true);
            };

            Plugin.construct.apply(the, [options]);

            return the;
        };

        var avatar = new KAvatar('#k_profile_avatar', {
            change: true,
            cancel: true
        });
    }

    p._Datepicker = function () {
        $('[data-input="datepicker"]').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd', 
            todayBtn: 'linked',
            todayHighlight: false
        }).on('changeDate show', function(e) {
            $('#form-account_information').bootstrapValidator('revalidateField', $(e.currentTarget).attr('name'));
        });
    }

    p._validate = function () {
        var form = $('#form-account_information').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                employee_number: {
                    message: 'The ID No. is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The ID No. is required.'
                        }
                    }
                },
                picture: {
                    message: 'The Picture is not valid',
                    validators: {
                        file: {
                            extension: 'jpg,jpeg,png',
                            type: 'image/jpg,image/jpeg,image/png',
                            maxSize: 2048 * 1024,
                            message: 'The selected file is not valid'
                        }
                    }
                },
                first_name: {
                    message: 'The First name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The First name is required.'
                        }
                    }
                },
                last_name: {
                    message: 'The Last name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Last name is required.'
                        }
                    }
                },
                birthday: {
                    message: 'The Birthday is not valid',
                    validators: {
                        callback: {
                            message: 'Please enter a valid date format (yyyy-mm-dd).',
                            callback: function (value, validator) {
                                if(!_.isEmpty(value)) {
                                    var m = new moment(value, 'YYYY-MM-DD', true);

                                    return m.isValid();
                                }

                                return true;
                            }
                        }
                    }
                },
                email: {
                    message: 'The Email is not valid',
                    validators: {
                        callback: {
                            message: 'The value is not a valid email address',
                            callback: function (value, validator) {
                                var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

                                if(!_.isEmpty(value)) {
                                    return pattern.test(value);
                                }

                                return true;
                            }
                        }
                    }
                },
                address: {
                    message: 'The Address is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Address is required.'
                        }
                    }
                },
            }
        })
        .on('success.form.bv', function(e) {
            e.preventDefault();

            $('#alert-message').html('');
            $('button').attr('disabled', 'disabled');

            var form_data = new FormData($(e.target)[0]);

            axios({
                method: 'POST',
                url: form.attr('action'),
                data: form_data
            }).then(function (response) {
                 $('#alert-message').append('<div class="alert alert-success">\
                        <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>\
                        <strong>' + response.data.message + '</strong>\
                    </div>\
                ');

                form.find('.form-group').removeClass('has-success');
                $('button').removeAttr('disabled');
            }).catch(function (error) {
                var error_message = $('<div>', {
                    class: 'alert alert-danger',
                    html:  '<button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>\
                            <strong>Something went wrong!</strong>\
                            <ul id="error_list"></ul>'
                })

                if(!_.some(error.response.data.errors, _.isEmpty)) {
                    _.forEach(error.response.data.errors, function (row) {
                        _.forEach(row, function (row) {
                            error_message.find('ul').append('<li>' + row + '</li>');
                        })
                    })
                }
                
                error_message.appendTo($('#alert-message'));
                $('button').removeAttr('disabled');
            });
        });

        $('#btn-update_agent').click(function () {
            form.submit();
        })
    }

    namespace.js = new js;

}(this, jQuery));
</script>
@endpush
