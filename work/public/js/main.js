'use strict';
{
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change',() => {
            checkbox.parentNode.submit();
        });
    });

    //developブランチのテスト、二回目のテスト
}