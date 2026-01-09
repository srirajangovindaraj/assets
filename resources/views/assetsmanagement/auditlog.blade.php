@extends('assetsmanagement::layouts.app')

@section('content')
<div class="mx-auto px-6 py-8">

         @livewire('log-table', [
        'auditlog' => $auditlog
    ])

</div>
@endsection
