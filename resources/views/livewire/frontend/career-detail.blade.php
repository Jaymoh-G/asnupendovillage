<div>
    <div class="container space-top space-extra-bottom">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="service-card">
                    <div class="box-content">
                        <h2 class="box-title">{{ $career->title }}</h2>
                        <p class="box-text">{{ $career->description }}</p>


                        <hr />
                        
                        <a
                            href="mailto:{{ $career->email }}?subject=Application for {{ urlencode($career->title) }}"
                            class="th-btn btn-sm"
                            >Apply Now via Email</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
