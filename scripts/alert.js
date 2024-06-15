function showAlert(type, message) {
    let title;
    if (type === 'success') {
        title = 'Sukces!';
    } else if (type === 'error') {
        title = 'Błąd!';
    }

    const alertDiv = document.createElement('div');
    alertDiv.className = `alert ${type}`;
    alertDiv.innerHTML = `<strong>${title}</strong>${message}`;
    document.body.appendChild(alertDiv);

    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}