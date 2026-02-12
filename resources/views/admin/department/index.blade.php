@extends('admin.layout.app')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
.modal{
display:none;
position:fixed;
left:0;
top:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.5);
z-index:9999;
}

.modal-content{
background:#fff;
width:400px;
margin:8% auto;
padding:20px;
border-radius:8px;
}

.close{
float:right;
cursor:pointer;
font-size:20px;
}
</style>

<div class="main-content">
<div class="card">

<div class="card-header d-flex justify-content-between">
<h3>Department</h3>

<button class="btn btn-primary" id="addDepartmentBtn">
<i class="fas fa-plus"></i> Add
</button>
</div>

<div class="card-body">

<table class="table table-bordered">
<thead>
<tr>
<th>SR. No</th>
<th>Name</th>
<th>Actions</th>
</tr>
</thead>
<tbody id="departmentTable"></tbody>
</table>

</div>
</div>
</div>

<!-- MODAL -->
<div id="departmentModal" class="modal">
<div class="modal-content">

<h4 id="modalTitle">Add Department</h4>
<span class="close" id="closeModal">&times;</span>

<form id="departmentForm">
<input type="hidden" id="departmentId">

<label>Name</label>
<input type="text" id="name" class="form-control" required>

<div style="margin-top:20px">
<button type="submit" class="btn btn-primary">Save</button>
<button type="button" id="cancelBtn" class="btn btn-danger">Cancel</button>
</div>
</form>

</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function(){

// CSRF setup
$.ajaxSetup({
headers:{
'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
}
});


// ================= LOAD DATA =================
function loadDepartments(){

$.get("{{ url('admin/department/list') }}", function(data){

let html='';

if(data.length===0){
html='<tr><td colspan="3">No record found</td></tr>';
}

data.forEach((item,index)=>{
html+=`
<tr>
<td>${index+1}</td>
<td>${item.name}</td>
<td>
<button class="btn btn-warning btn-sm editBtn" data-id="${item.id}">Edit</button>
<button class="btn btn-danger btn-sm deleteBtn" data-id="${item.id}">Delete</button>
</td>
</tr>`;
});

$('#departmentTable').html(html);

});

}

loadDepartments();


// ================= OPEN MODAL =================
$('#addDepartmentBtn').on('click', function(){

$('#departmentForm')[0].reset();
$('#departmentId').val('');
$('#modalTitle').text('Add Department');

$('#departmentModal').fadeIn();

});


// ================= CLOSE MODAL =================
$('#closeModal, #cancelBtn').on('click', function(){
$('#departmentModal').fadeOut();
});


// ================= STORE / UPDATE =================
$('#departmentForm').on('submit', function(e){

e.preventDefault();

let id=$('#departmentId').val();

let url=id
? `{{ url('admin/department/update') }}/${id}`
: `{{ url('admin/department/store') }}`;

$.post(url,{
name:$('#name').val()
},function(){

$('#departmentModal').fadeOut();
loadDepartments();

});

});


// ================= EDIT =================
$(document).on('click','.editBtn',function(){

let id=$(this).data('id');

$.get(`{{ url('admin/department/edit') }}/${id}`,function(data){

$('#departmentId').val(data.id);
$('#name').val(data.name);
$('#modalTitle').text('Edit Department');

$('#departmentModal').fadeIn();

});

});


// ================= DELETE =================
$(document).on('click','.deleteBtn',function(){

let id=$(this).data('id');

if(!confirm('Delete this department?')) return;

$.ajax({
url:`{{ url('admin/department/delete') }}/${id}`,
type:'DELETE',
success:function(){
loadDepartments();
}
});

});

});
</script>

@endsection
