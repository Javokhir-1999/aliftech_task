@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8" style="margin-top:40px">
            <h4 class="p-2 border-bottom border-secondary">Contacts</h4>
            <form action="{{ route('search')}}" method="GET">
                <div class="row form-group">
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="query" maxlength="39" placeholder="Search ..." value="{{ request()->input('query') }}">
                        <span class="text-danger">@error('query'){{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info  text-opacity-75 text-white btn-custom">Search</button>
                    </div>
                    <div class="col-md-2">
                        <button data-bs-toggle="modal" data-bs-target="#addContact" type="button" class="btn btn-defoult border border-secondary btn-custom">
                            <img style="max-width:23px;"src="/img/add-user.png" alt="add contact">
                        </button>
                        @include('contacts.contact-add')
                    </div>
                </div>
            </form>
            <br>
            <br>
            <br>
            @if(isset($contacts))

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Names</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <form method="Post" class="form-validate" action="">
                    @csrf
                    @if(count($contacts) > 0)
                    @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm text-white">Show</button>
                            <button type="button" class="btn btn-info btn-sm">Update</button>
                            <a href="{{ route('destroy', $contact->id)}}" class="btn btn-danger btn-sm">X</a>                            
                        </td>
                    </tr>
                    @endforeach
                    @else

                    <tr>
                        <td>Contact not found!</td>
                    </tr>
                    @endif
                    </form>   
                </tbody>
            </table>

            <div class="pagination-block">
                {{ $contacts->appends(request()->input())->links('layouts.pagination') }}
            </div>

            @endif
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function (){

        var phoneLimit = 2;
        var emailLimit = 2;

        $(".add-phone").on('click', function(){ 
            if(phoneLimit > 1){
                phoneLimit++;
                $(".phones").append(`
                <input type="phone" name="`+phoneLimit+`" id="phone`+phoneLimit+`" onkeyup="this.value = this.value.replace (/[^0-9+]/, '')"       
                placeholder="+998......" maxlength="13" class="form-control phone-form-control" />
                `);
            }
        });

        $(".add-email").on('click', function(){ 
            if(emailLimit > 1){
                emailLimit--;
                $(".emails").append(`
                <input type="text" name="`+emailLimit+`" id="email`+emailLimit+`" class="form-control email-form-control" 
                placeholder="demo@email.adress" aria-label="Email adress" aria-describedby="basic-addon2">
                `);
            }
        });    

        $(document).on('click', '.add-contacts', function (e){
            var contactData = {
                'name': $('#name').val(),
                'phone': $('#phone').val(),
                'phone0': $('#phone0').val(),
                'phone1': $('#phone1').val(),
                'email': $('#email').val(),
                'email0': $('#email0').val(),
                'email1': $('#email1').val(),
            }         
            var nameRegExp = new RegExp("^(.*[a-z]){3,}$");
            var phoneRegExp = new RegExp("^(.*[0-9]){9}$");
            if (nameRegExp.test(contactData.name)) {
                if (phoneRegExp.test(contactData.phone)){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "/contacts/add",
                        data: contactData,
                        dataType: "json",
                        success: function (response) {
                            console.log(response);

                            if(response.status = 200)
                                $('#addContact').hide();
                                $('.modal-backdrop').hide();
                                location.reload();
                        
                            alert(response.message);
                        }
                    });
                }else{
                    alert('Plase at least one and correct phone number  !')
                }
            }else{
                alert('Plase Enter correct Contact name and at least three letters!')
            }
            
        });
    });
</script>
@endsection