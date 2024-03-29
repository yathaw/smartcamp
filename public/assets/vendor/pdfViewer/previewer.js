
var _PDF_DOC,
    _CURRENT_PAGE,
    _TOTAL_PAGES,
    _PAGE_RENDERING_IN_PROGRESS = 0,
    _CANVAS = document.querySelector('#preview-pdf-canvas');

// initialize and load the PDF
async function preview_showPDF(pdf_url) {
    document.querySelector("#preview-pdf-loader").style.display = 'block';

    // get handle of pdf document
    try {
        _PDF_DOC = await pdfjsLib.getDocument({ url: pdf_url });
    }
    catch(error) {
        alert(error.message);
    }

    // total pages in pdf
    _TOTAL_PAGES = _PDF_DOC.numPages;
    
    // Hide the pdf loader and show pdf container
    document.querySelector("#preview-pdf-loader").style.display = 'none';
    document.querySelector("#preview-pdf-contents").style.display = 'block';
    document.querySelector("#preview-pdf-total-pages").innerHTML = _TOTAL_PAGES;

    // show the first page
    preview_showPage(1);
}

// load and render specific page of the PDF
async function preview_showPage(page_no) {
    _PAGE_RENDERING_IN_PROGRESS = 1;
    _CURRENT_PAGE = page_no;

    // disable Previous & Next buttons while page is being loaded
    document.querySelector("#preview-pdf-next").disabled = true;
    document.querySelector("#preview-pdf-prev").disabled = true;

    // while page is being rendered hide the canvas and show a loading message
    document.querySelector("#preview-pdf-canvas").style.display = 'none';
    document.querySelector("#preview-page-loader").style.display = 'block';

    // update current page
    document.querySelector("#preview-pdf-current-page").innerHTML = page_no;
    
    // get handle of page
    try {
        var page = await _PDF_DOC.getPage(page_no);
    }
    catch(error) {
        alert(error.message);
    }

    // original width of the pdf page at scale 1
    var pdf_original_width = page.getViewport(1).width;
    
    // as the canvas is of a fixed width we need to adjust the scale of the viewport where page is rendered
    var scale_required = _CANVAS.width / pdf_original_width;

    // get viewport to render the page at required scale
    var viewport = page.getViewport(scale_required);

    // set canvas height same as viewport height
    _CANVAS.height = viewport.height;

    // setting page loader height for smooth experience
    document.querySelector("#preview-page-loader").style.height =  _CANVAS.height + 'px';
    document.querySelector("#preview-page-loader").style.lineHeight = _CANVAS.height + 'px';

    // page is rendered on <canvas> element
    var render_context = {
        canvasContext: _CANVAS.getContext('2d'),
        viewport: viewport
    };
        
    // render the page contents in the canvas
    try {
        await page.render(render_context);
    }
    catch(error) {
        alert(error.message);
    }

    _PAGE_RENDERING_IN_PROGRESS = 0;

    // re-enable Previous & Next buttons
    document.querySelector("#preview-pdf-next").disabled = false;
    document.querySelector("#preview-pdf-prev").disabled = false;

    // show the canvas and hide the page loader
    document.querySelector("#preview-pdf-canvas").style.display = 'block';
    document.querySelector("#preview-page-loader").style.display = 'none';
}



// click on the "Previous" page button
document.querySelector("#preview-pdf-prev").addEventListener('click', function() {
    if(_CURRENT_PAGE != 1)
        preview_showPage(--_CURRENT_PAGE);
});

// click on the "Next" page button
document.querySelector("#preview-pdf-next").addEventListener('click', function() {
    if(_CURRENT_PAGE != _TOTAL_PAGES)
        preview_showPage(++_CURRENT_PAGE);
});