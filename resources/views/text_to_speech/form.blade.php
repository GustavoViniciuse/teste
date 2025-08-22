<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Pratico</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Conversor de Texto para Áudio</h1>
            <form action="/convert" method="POST">
                @csrf
                <div class="form-group">
                    <label for="text">Digite o texto:</label>
                    <textarea name="text" id="text" rows="5" required>{{ old('text', $original_text ?? '') }}</textarea>
                </div>
                <button type="submit" class="btn">Converter</button>
            </form>

            @if(isset($audio) && !empty($audio))
                <div class="audio-output">
                    <h4>Áudio gerado:</h4>
                    <p class="audio-text">"{{ $original_text }}"</p>
                    <audio controls>
                        <source src="data:audio/mpeg;base64,{{ $audio }}" type="audio/mpeg">
                        Seu navegador não suporta o elemento de áudio.
                    </audio>
                </div>
            @endif

            @error('api_error')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @error('text')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</body>
</html>