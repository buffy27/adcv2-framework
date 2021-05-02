import EasyMDE from 'easymde';

var markdown_editor = document.getElementsByTagName("textarea");

var release_details = new EasyMDE({
    element: markdown_editor[0],
    promptURLs: true,
    tabSize: 4,
    spellChecker: true,
    nativeSpellcheck: true,
    sideBySideFullscreen: false,
    maxHeight: '200px',
    toolbar: [
        "bold", "italic", "strikethrough", "|",
        "code", "quote", "|",
        "ordered-list", "unordered-list", "|",
        "link", "image", "|",
        "horizontal-rule", "clean-block", "|",
        "side-by-side"
    ]
});

release_details.toggleSideBySide();

var contentInfo = new EasyMDE({
    element: markdown_editor[2],
    promptURLs: true,
    tabSize: 4,
    spellChecker: true,
    nativeSpellcheck: true,
    sideBySideFullscreen: false,
    maxHeight: '200px',
    toolbar: [
        "bold", "italic", "strikethrough", "|",
        "code", "quote", "|",
        "ordered-list", "unordered-list", "|",
        "link", "image", "|",
        "horizontal-rule", "clean-block", "|",
        "side-by-side"
    ]
});

contentInfo.toggleSideBySide();

var mediainfo = new EasyMDE({
    element: markdown_editor[4],
    promptURLs: true,
    tabSize: 4,
    spellChecker: true,
    nativeSpellcheck: true,
    sideBySideFullscreen: false,
    maxHeight: '200px',
    toolbar: [
        "bold", "italic", "strikethrough", "|",
        "code", "quote", "|",
        "ordered-list", "unordered-list", "|",
        "link", "image", "|",
        "horizontal-rule", "clean-block", "|",
        "side-by-side"
    ]
});

mediainfo.toggleSideBySide();