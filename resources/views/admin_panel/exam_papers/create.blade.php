<x-app-layout>
    <x-slot name="page_title">{{ $page_title ?? 'Exam Paper Create' }}</x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard') }}"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="{{ url('admin-panel/dashboard/exam-papers') }}"> Exam Paper List </a></li>
                            <li class="breadcrumb-item active"> Exam Paper Create </li>
                        </ol>
                    </div>

                    <h4 class="page-title"> Exam Paper Create </h4>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input. <br><br>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <form action="{{ url('admin-panel/dashboard/exam-papers') }}" method="POST" enctype="multipart/form-data">
                                @csrf
        
                                <div class="row">
                                    <div class="col-md-3"></div>

                                    <div class="mb-2 col-md-6">
                                        <input type="text" name="name" value="{{ old('name', $exam_paper->name ?? '') }}" class="form-control form-control-light text-center" id="name" placeholder="Exam Paper Name" required>
                                    </div>

                                    <div class="col-md-3"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"></div>

                                    <div class="mb-2 col-md-4">
                                        <select id="subject_id" name="subject_id" class="form-select form-control-light text-center" required>
                                            <option value="" selected disabled> Choose Subject </option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}" {{ (old('subject_id') ?? ($exam_paper->subject_id ?? '')) == $subject->id ? 'selected' : '' }}>
                                                    {{ $subject->name ?? "" }} - {{ $subject->code ?? "" }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2"></div>

                                    <div class="mb-2 col-md-8">
                                        <textarea name="description" id="description" class="form-control form-control-light text-center" rows="3">{{ old('description', $exam_paper->description ?? '') }}</textarea>
                                    </div>

                                    <div class="col-md-2"></div>
                                </div>

                                <div class="row">
                                    <div class="mb-2 col-md-2">
                                        <label for="date"> Date </label>
                                        <input type="date" name="date" value="{{ old('date', $exam_paper->date ?? '') }}" class="form-control form-control-light" id="date" required>
                                    </div>
                                    
                                    <div class="mb-2 col-md-2">
                                        <label for="time"> Time </label>
                                        <input type="time" name="time" value="{{ old('time', $exam_paper->time ?? '') }}" class="form-control form-control-light" id="time" required>
                                    </div>
                                    
                                    <div class="mb-2 col-md-2">
                                        <label for="duration"> Duration </label>
                                        <input type="number" name="duration" value="{{ old('duration', $exam_paper->duration ?? '') }}" class="form-control form-control-light" id="duration" required>
                                    </div>
                                    
                                    <div class="mb-2 col-md-2">
                                        <label for="total_mark"> Total Mark </label>
                                        <input type="number" name="total_mark" value="{{ old('total_mark', $exam_paper->total_mark ?? '') }}" class="form-control form-control-light" id="total_mark" required>
                                    </div>
                                    
                                    <div class="mb-2 col-md-2">
                                        <label for="per_question_mark"> Per Question Mark </label>
                                        <input type="text" name="per_question_mark" value="{{ old('per_question_mark', $exam_paper->per_question_mark ?? '') }}" class="form-control form-control-light" id="per_question_mark" required>
                                    </div>
                                    
                                    <div class="mb-2 col-md-2">
                                        <label for="per_question_negative_mark"> Per Question Negative Mark </label>
                                        <input type="text" name="per_question_negative_mark" value="{{ old('per_question_negative_mark', $exam_paper->per_question_negative_mark ?? '') }}" class="form-control form-control-light" id="per_question_negative_mark" required>
                                    </div>
                                </div>
            
                                <div class="modal-footer">
                                    <a href="{{ url('admin-panel/dashboard/exam-papers') }}" class="btn btn-primary"> Go Back </a>
                                    <button type="submit" class="btn btn-success"> Save </button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
