@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.setting.index') }}">Setting</a>
    <a href="{{ route('admin.setting.contact.index') }}">Contact</a>
@endsection
@section('active', 'setting')
@section('content')
    <div class="shadow mt-2 p-3 bg-white rounded">
        <div class="row mb-2">
            <div class="col-md-4 mb-2">
                <label for="cname">Name</label>
                @if ($contact)
                    <input type="text" name="cname" id="cname" class="form-control" value="{{ $contact->name }}"
                        required>
                @else
                    <input type="text" name="cname" id="cname" class="form-control" required>
                @endif
            </div>
            <div class="col-md-4 mb-2">
                <label for="address">address</label>
                @if ($contact)
                    <input type="text" name="address" id="address" class="form-control" value="{{ $contact->address }}"
                        required>
                @else
                    <input type="text" name="address" id="address" class="form-control" required>
                @endif

            </div>
            <div class="col-md-4 mb-2">
                <label for="phone">Phone No</label>
                @if ($contact)
                    <input type="number" name="phone" id="phone" class="form-control" value="{{ $contact->phone }}"
                        required>
                @else
                    <input type="number" name="phone" id="phone" class="form-control" required>
                @endif

            </div>
            <div class="col-md-4 mb-2">
                <label for="po_box">P.O.Box</label>
                @if ($contact)
                    <input type="number" name="po_box" id="po_box" class="form-control" value="{{ $contact->po_box }}"
                        required>
                @else
                    <input type="number" name="po_box" id="po_box" class="form-control" required>
                @endif
            </div>
            <div class="col-md-4 mb-2">
                <label for="email">Email</label>
                @if ($contact)
                    <input type="email" name="email" id="email" class="form-control" value="{{ $contact->email }}"
                        required>
                @else
                    <input type="email" name="email" id="email" class="form-control" required>
                @endif
            </div>
            <div class="col-12">
                <button class="btn btn-primary" onclick="saveAll()">
                    Save Contact
                </button>
            </div>

        </div>
    </div>
    <div class="shadow mt-2 p-3 bg-white rounded">

        <div class="row">
            <div class="col-12">
                <div class="shadow rounded p-3">
                    <h5 style="display: flex;justify-content: space-between;align-items: center">
                        <span>Individual Contact</span>

                    </h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-2 ml-3"> <strong>Post</strong></div>
                        <div class="col-md-3 ml-3"> <strong>Name</strong></div>
                        <div class="col-md-3 ml-3"> <strong>Phone</strong></div>
                        <div class="col-md-3 ml-3"> <strong>Email</strong></div>
                        <div class="col-md-1">

                        </div>
                    </div>
                    <form action="{{ route('admin.setting.contact.add') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-2 mb-2">
                                <input type="text" name="post" id="post" class="form-control">
                            </div>
                            <div class="col-md-3 mb-2">
                                <input type="text" name="name" id="name" class="form-control" />
                            </div>
                            <div class="col-md-3 mb-2">

                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="col-md-3 mb-2">
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="col-md-1 text-start">
                                <button class="btn btn-success btn-sm">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                    <div id="individual_contacts">
                        @foreach ($individualcontacts as $contact)
                        <form action="{{route('admin.setting.contact.update')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$contact->id}}">
                            <hr class="my-1">
                            <div class="row" id="individual_contact_show_{{ $contact->id }}">
                                <div class="col-md-2 mb-2">
                                    <input type="text" name="post" id="post_{{ $contact->id }}"
                                        value="{{ $contact->post }}" class="form-control">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <input type="text" name="name" id="name_{{ $contact->id }}"
                                        class="form-control" value="{{ $contact->name }}">
                                </div>
                                <div class="col-md-3 mb-2">

                                    <input type="text" name="phone" id="phone_{{ $contact->id }}"
                                        class="form-control" value="{{ $contact->phone }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <input type="text" name="email" id="email_{{ $contact->id }}"
                                        class="form-control" value="{{ $contact->email }}">
                                </div>
                                <div class="col-md-12 ">
                                    <button class="btn btn-sm btn-primary">
                                        Update
                                    </button>
                                    <span class="btn btn-sm btn-danger" onclick="delOld({{ $contact->id }})">
                                        Del
                                    </span>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection
    @section('js')
        <script>
            function saveAll() {
                var cname = $('#cname').val();
                var address = $('#address').val();
                var phone = $('#phone').val();
                var email = $('#email').val();
                var po_box = $('#po_box').val();
                var individualContactsDatas = [];


                const data = {
                    cname: cname,
                    address: address,
                    phone: phone,
                    email: email,
                    po_box: po_box,
                };

                axios.post('{{ route('admin.setting.contact.index') }}', data)
                    .then(res => {
                        success('successfully Updated');
                    })
                    .catch(err => {
                        console.error(err);
                    });
            };

            function delOld(id) {
                axios.get("{{ route('admin.setting.contact.del', ['contact_id' => ':id']) }}".replace(':id', id))
                    .then(res => {
                        success('successfully deleted')
                        $(`#individual_contact_show_${id}`).remove();
                        $('#hr_old_' + id).remove();
                    })
                    .catch(err => {
                        console.error(err);
                    })
            }

            function delNew(id) {
                $(`#individual_contact_${id}`).remove();
                $('#hr_new_' + id).remove();
            }
        </script>
    @endsection
