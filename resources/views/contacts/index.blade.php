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
                        @include('layouts.contact-add')
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
                    </tr>
                </thead>
                <tbody>
                    @if(count($contacts) > 0)
                    @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                    </tr>
                    @endforeach
                    @else

                    <tr>
                        <td>Contact not found!</td>
                    </tr>
                    @endif
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
        $(document).on('click', '.add-contacts', function (e){
            e.preventDefault();
            var data = {
                'name': $('#name').val(),
                'phone': $('#phone').val(),
                'email': $('#email').val(),
            }

            $.ajax({
                type: "POST",
                url: "/contacts",
                data: data,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.status == 400) {
                        $('#save_msgList').html("");
                        $('#save_msgList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_value) {
                            $('#save_msgList').append('<li>' + err_value + '</li>');
                        });
                        $('.add_student').text('Save');
                    } else {
                        $('#save_msgList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#AddStudentModal').find('input').val('');
                        $('.add_student').text('Save');
                        $('#AddStudentModal').modal('hide');
                        fetchstudent();
                    }
                }
            });

            // console.log(data);
        });
    });
</script>
@endsection