@extends('adminlte::page')

@section('title', '商品一覧')

<style>
    label {
        text-indent: 1rem;
        }
    .items {
        padding-top: 100px;
        margin: 0 auto;
        }
    .form-group.item {
        margin-bottom: 1rem;
    }
    .btn {
        margin-top: 30px;
        padding: 5px 60px;
        }
    </style>

@section('content')
<div class="items col-md-6">
    <form action="{{ url('itemEdit') }}" method="POST">
        @csrf
        <!-- 編集フォーム -->
        <input class="form-control" type="text" name="id" value="{{ $item->id }}" hidden>
        <div class="form-group item">
            <label for="name">名前</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $item->name) }}">
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="type">種別</label>
            <select type="text" name="type" class="form-control" required>
                @foreach (Config::get('const.type') as $key => $val)
                    <option value="{{ $key }}" @if( old('type')== $key) selected @endif>{{ $val }}</option>
                @endforeach
                @error('type')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </select>
        </div>
        <div class="form-group">
            <label for="stock">在庫</label>
            <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock', $item->stock) }}" placeholder="在庫数">
            @error('stock')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group item">
            <label for="detail">詳細</label>
            <input type="text" name="detail" id="detail" class="form-control" value="{{ old('detail', $item->detail) }}">
            @error('detail')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <!-- 編集ボタン -->
            <button type="submit" class="btn btn-outline-secondary">更新</button>
    </form>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
