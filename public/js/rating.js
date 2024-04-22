let data = [
    { 'star': 5, 'count': 9980 },
    { 'star': 4, 'count': 980 },
    { 'star': 3, 'count': 123 },
    { 'star': 2, 'count': 1236 },
    { 'star': 1, 'count': 67 }
];

const totalCount = data.reduce((sum, rating) => sum + rating.count, 0);

data.forEach(rating => {
    const barWidth = (rating.count / totalCount) * 100; // Calculate the bar width as a percentage

    let ratingProgress = `
        <div class="rating-progress-value gap-x-4 flex items-center justify-between">
            <p class="text-lg">${rating.star} <span class="star text-2xl text-[#FFD43B]">&#9733;</span></p>
            <div class="progress h-2.5 bg-neutral-400 rounded-full">
                <div class="bar h-full bg-[#FFD43B] rounded-full" style="width: ${barWidth}%;"></div>
            </div>
            <p>${rating.count.toLocaleString()}</p>
        </div>
    `;
    document.querySelector('.rating-progress').innerHTML += ratingProgress;
});