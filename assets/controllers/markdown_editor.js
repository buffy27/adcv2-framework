import EasyMDE from 'easymde';

var markdown_editor = document.getElementsByTagName("textarea");

var editor = new EasyMDE({
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

editor.toggleSideBySide();