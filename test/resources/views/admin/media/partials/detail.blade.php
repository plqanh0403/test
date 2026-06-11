<div class="modal fade" id="mediaModal{{ $item->id }}">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5>

                    Media Detail

                </h5>

            </div>

            <div class="modal-body">

                @if($item->type === 'image')

                    <img src="{{ Storage::url($item->path) }}" class="img-fluid rounded">

                @endif

                <hr>

                <p>

                    <strong>Name:</strong>

                    {{ $item->original_name }}

                </p>

                <p>

                    <strong>Folder:</strong>

                    {{ $item->folder }}

                </p>

                <p>

                    <strong>Mime:</strong>

                    {{ $item->mime_type }}

                </p>

                <p>

                    <strong>Size:</strong>

                    {{ number_format($item->size/1024,1) }}
                    KB

                </p>

                <p>

                    <strong>URL:</strong>

                    {{ $item->url }}

                </p>

                <p>

                    <strong>Uploaded by:</strong>

                    {{ $item->user->username }}

                </p>

            </div>

        </div>

    </div>

</div>
