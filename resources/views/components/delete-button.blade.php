@props(['url'])
<div>
    <button
        class="btn btn-sm btn-danger"
        onclick="confirmDelete('{{ $url }}')"><i class="bi bi-trash"></i>
    </button>
</div>
