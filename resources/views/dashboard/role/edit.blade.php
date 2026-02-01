@extends('dashboard.layouts.main')

@section('title')
	Dashboard Admin | Edit Hak Akses
@endsection

@section('content')
	<div class="title-container">
		<div>
			<h1 class="title">Edit Data Hak Akses</h1>
			<ul class="breadcrumbs">
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="{{ route('role.index') }}">Hak Akses</a></li>
				<i class='bx bx-chevron-right divider'></i>
				<li><a href="" class="active">Edit</a></li>
			</ul>
		</div>
	</div>

    	<x-alert-success-error type="'error'" :session="session('error')"/>


    <form method="POST" action="{{ route('role.update', $role->id_role)}}" class="w-full rounded-lg bg-white dark:bg-gray-800/50 shadow-md shadow-gray-200/60 dark:shadow-violet-800/20 p-3 sm:p-6 space-y-4">
        @csrf
        @method('PUT')
        <!-- Input Text -->
        <div class="text-gray-600 dark:text-gray-400">
            <label class="text-sm font-medium ">Nama Role</label>
            <input type="text" value="{{old('role', $role->role)}}" name="role" placeholder="Masukkan Nama Role" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-violet-500 focus:outline-none focus:ring-1 focus:ring-violet-500"/>
        </div>
        <x-input-error name="role" />

        <!-- Button (Left) -->
        <div class="flex justify-end items-center">
            <x-button-edit :update="true"></x-button-edit>
        </div>
    </form>

    
@endsection