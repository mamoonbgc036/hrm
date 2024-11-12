@extends('layouts.app')
@section('title','Add Nominee')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-users" aria-hidden="true"></i> Add Nominee</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('employee.edit',request('employee'))}}" class="btn btn-success"><i class="fa fa-backward" aria-hidden="true"></i></a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="vue_app">
                <div class="card mt-2">
                    <div class="card-header bg-info">
                        <span class="card-title text-white">Insert Nominee</span>
                    </div>
                    <div class="card-body">
                        <form  action="{{route('nominee.store')}}" method="post" >
                            @csrf
                            <input type="hidden" name="employee_id" value="{{request('employee')}}" class="form-control input-sm">

                            <table class="table table-hover table-bordered" id="" style="width:100%;" >
                                <thead>
                                <tr>
                                    <th>Nominee Name</th>
                                    <th>Relationship</th>
                                    <th>Nid</th>
                                    <th>Permanent Address</th>
                                    <th>Percentage %</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(row, index) in nominee_inputs">
                                    <input type="hidden" name="employee_id" value="{{request('employee')}}">
                                    <td>
                                        <input class="form-control" :name="'nominee['+index+'][name]'" value="{{old('name')}}" type="text" required>
                                    </td>
                                    <td>
                                        <select class="form-control" :name="'nominee['+index+'][relationship_id]'" required>
                                            <option value="" disabled selected>Select All</option>
                                            @foreach($relationship as $row)
                                                <option value="{{$row->id}}" {{$row->id==old('relationship')?'selected':''}}>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control" type="number" :name="'nominee['+index+'][nid_no]'">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" :name="'nominee['+index+'][permanent_address]'">
                                    </td>
                                    <td>
                                        <input class="form-control" v-model="form.percentage[index]" :id="'percentage'+index+''" min="1" type="number" :name="'nominee['+index+'][percentage]'"  required>
                                    </td>
                                    <td>
                                        <button type="button" @click="removeId(row.id)" class="btn btn-sm btn-danger">Remove</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-success" type="button" id="" @click.preventDefault="addMoreNominee">Add More</button>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')

    <script>
        $(document).ready(function () {
            var vue = new Vue({
                el: '#vue_app',
                data: {
                    nominee:[],
                    nominee_inputs:[1],
                    form: {
                        percentage : [],
                    },
                    allerros: [],
                },
                methods: {
                    addMoreNominee(){
                        var availablePercentage = '{{ $availablePercentage }}';
                        var firstValue = $('#percentage0').val();

                        var sum = 0;
                        this.form.percentage.forEach(e => {
                            sum += Number(e);
                        });
                        var available = availablePercentage - sum;

                        /*this.form.percentage.forEach((index, value) => {
                            this.form.percentage[length] = available

                        });*/

                        console.log('available:' + available);
                        console.log('firstValue:' + firstValue);
                        console.log('Total value:' + sum);

                        if(availablePercentage > sum){
                            this.nominee_inputs.push(1);
                            var length = this.form.percentage.length;
                            this.form.percentage[length] = available
                        }else{
                            toastr.error('No available percentage.', {
                                closeButton: true,
                                progressBar: true,
                            });
                        }


                        /*this.form.percentage.forEach((index, value) => {
                            this.form.percentage[length] = available
                            //console.log(value);
                            //$('#percentage'+value+'').val(available);
                        });*/

                        //console.log(sum);

                    },
                    removeId(index){
                        this.nominee_inputs.splice(this.nominee_inputs.indexOf(index), 1);
                    },
                },
                computed: {
                    sum: function (){
                        let sum = 0;

                        $.each(this.form.percentage,function (index, value){
                            //console.log(value);
                            sum = sum + Number(value);
                        })
                        return sum;
                    }
                },
                mounted: function (){
                    $('#percentage0').val('{{ $availablePercentage }}');

                }
            });

        });
    </script>
@endpush
