<template>
    <div class="inventory__container" id="items">
        <div class="inventory__list" v-if="filteredItems.length >= 1">
            <div
                class="list__item"
                v-for="(item, index) in filteredItems"
                :key="index"
            >
                <div class="item__status__controller">
                    <div class="item__statuses_left">
                        <div
                            @click="withdraw(item.id)"
                            v-if="item.status === 0"
                            class="status"
                            datatype="withdraw"
                            data-tip="Вывод"
                            currentitem="false"
                        >
                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g clip-path="url(#clip0_204_27246)">
                                    <path
                                        d="M4.862 4.74733C4.60133 4.48667 4.60133 4.06533 4.862 3.80467C5.12267 3.544 5.544 3.544 5.80467 3.80467L7.33333 5.33333V0.666667C7.33333 0.298 7.63133 0 8 0C8.36867 0 8.66667 0.298 8.66667 0.666667V5.33333L10.1953 3.80467C10.456 3.544 10.8773 3.544 11.138 3.80467C11.3987 4.06533 11.3987 4.48667 11.138 4.74733L8.94267 6.94267C8.68467 7.20067 8.34533 7.33067 8.006 7.332L8 7.33333L7.994 7.332C7.65467 7.33067 7.31533 7.20067 7.05733 6.94267L4.862 4.74733ZM14 8H12C11.2647 8 10.6667 8.598 10.6667 9.33333C10.6667 10.0687 10.0687 10.6667 9.33333 10.6667H6.66667C5.93133 10.6667 5.33333 10.0687 5.33333 9.33333C5.33333 8.598 4.73533 8 4 8H2C0.897333 8 0 8.89733 0 10V12.6667C0 14.5047 1.49533 16 3.33333 16H12.6667C14.5047 16 16 14.5047 16 12.6667V10C16 8.89733 15.1027 8 14 8Z"
                                        fill="#113F15"
                                    />
                                </g>
                                <defs>
                                    <clipPath id="clip0_204_27246">
                                        <rect
                                            width="16"
                                            height="16"
                                            fill="white"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <div class="item__statuses">
                        <div
                            @click="fetchSimilarItems(item.id)"
                            v-if="item.status === 0"
                            class="status"
                            datatype="replaceItem"
                            data-tip="Заменить"
                            currentitem="false"
                        >
                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M0 4.66665C0 4.48984 0.0702379 4.32027 0.195262 4.19525C0.320286 4.07022 0.489856 3.99998 0.666667 3.99998H12V1.75932C12.0013 1.65562 12.0331 1.55461 12.0915 1.46888C12.1498 1.38315 12.2321 1.3165 12.3281 1.27725C12.4241 1.238 12.5295 1.22789 12.6312 1.24818C12.7329 1.26846 12.8264 1.31825 12.9 1.39132L15.8453 4.29865C15.8939 4.34659 15.9324 4.40368 15.9587 4.46662C15.985 4.52956 15.9986 4.5971 15.9986 4.66532C15.9986 4.73354 15.985 4.80107 15.9587 4.86402C15.9324 4.92696 15.8939 4.98405 15.8453 5.03198L12.9 7.94199C12.8264 8.01506 12.7329 8.06484 12.6312 8.08513C12.5295 8.10541 12.4241 8.0953 12.3281 8.05605C12.2321 8.0168 12.1498 7.95015 12.0915 7.86442C12.0331 7.7787 12.0013 7.67768 12 7.57398V5.33332H0.666667C0.489856 5.33332 0.320286 5.26308 0.195262 5.13806C0.0702379 5.01303 0 4.84346 0 4.66665ZM15.3333 10.6667H4V8.42598C3.99869 8.32229 3.96688 8.22127 3.90852 8.13555C3.85017 8.04982 3.76787 7.98317 3.67188 7.94392C3.57589 7.90467 3.47046 7.89456 3.36876 7.91484C3.26706 7.93513 3.17359 7.98491 3.1 8.05798L0.154667 10.9653C0.10613 11.0133 0.0675923 11.0703 0.04129 11.1333C0.0149877 11.1962 0.00144381 11.2638 0.00144381 11.332C0.00144381 11.4002 0.0149877 11.4677 0.04129 11.5307C0.0675923 11.5936 0.10613 11.6507 0.154667 11.6987L3.1 14.6087C3.17359 14.6817 3.26706 14.7315 3.36876 14.7518C3.47046 14.7721 3.57589 14.762 3.67188 14.7227C3.76787 14.6835 3.85017 14.6168 3.90852 14.5311C3.96688 14.4454 3.99869 14.3443 4 14.2407V12H15.3333C15.5101 12 15.6797 11.9297 15.8047 11.8047C15.9298 11.6797 16 11.5101 16 11.3333C16 11.1565 15.9298 10.9869 15.8047 10.8619C15.6797 10.7369 15.5101 10.6667 15.3333 10.6667Z"
                                    fill="url(#paint0_linear_28082_43189)"
                                />
                                <defs>
                                    <linearGradient
                                        id="paint0_linear_28082_43189"
                                        x1="0"
                                        y1="1.23798"
                                        x2="17.7585"
                                        y2="4.19246"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#1E2534" />
                                        <stop offset="1" stop-color="#151A25" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div
                            @click="sellSkin(item.id)"
                            v-if="item.status === 0"
                            class="status"
                            datatype="sellItem"
                            data-tip="Продать"
                            currentitem="false"
                        >
                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g clip-path="url(#clip0_204_27202)">
                                    <path
                                        d="M15.142 2.718C14.9545 2.49296 14.7197 2.31197 14.4544 2.18788C14.189 2.06379 13.8996 1.99964 13.6067 2H2.828L2.8 1.766C2.7427 1.27961 2.50892 0.831155 2.14299 0.505652C1.77706 0.180149 1.30442 0.000227862 0.814667 0L0.666667 0C0.489856 0 0.320286 0.0702379 0.195262 0.195262C0.0702379 0.320286 0 0.489856 0 0.666667C0 0.843478 0.0702379 1.01305 0.195262 1.13807C0.320286 1.2631 0.489856 1.33333 0.666667 1.33333H0.814667C0.977956 1.33335 1.13556 1.3933 1.25758 1.50181C1.3796 1.61032 1.45756 1.75983 1.47667 1.922L2.394 9.722C2.48923 10.5332 2.87899 11.2812 3.48927 11.824C4.09956 12.3668 4.8879 12.6667 5.70467 12.6667H12.6667C12.8435 12.6667 13.013 12.5964 13.1381 12.4714C13.2631 12.3464 13.3333 12.1768 13.3333 12C13.3333 11.8232 13.2631 11.6536 13.1381 11.5286C13.013 11.4036 12.8435 11.3333 12.6667 11.3333H5.70467C5.29204 11.3322 4.88987 11.2034 4.55329 10.9647C4.21671 10.726 3.96221 10.389 3.82467 10H11.7713C12.5529 10 13.3096 9.72549 13.9092 9.22429C14.5089 8.7231 14.9134 8.02713 15.052 7.258L15.5753 4.35533C15.6276 4.06734 15.6158 3.77138 15.5409 3.48843C15.4661 3.20547 15.3299 2.94245 15.142 2.718Z"
                                        fill="#113F15"
                                    />
                                    <path
                                        d="M4.66927 16C5.40565 16 6.0026 15.403 6.0026 14.6666C6.0026 13.9303 5.40565 13.3333 4.66927 13.3333C3.93289 13.3333 3.33594 13.9303 3.33594 14.6666C3.33594 15.403 3.93289 16 4.66927 16Z"
                                        fill="#113F15"
                                    />
                                    <path
                                        d="M11.3333 16C12.0697 16 12.6667 15.403 12.6667 14.6666C12.6667 13.9303 12.0697 13.3333 11.3333 13.3333C10.597 13.3333 10 13.9303 10 14.6666C10 15.403 10.597 16 11.3333 16Z"
                                        fill="#113F15"
                                    />
                                </g>
                                <defs>
                                    <clipPath id="clip0_204_27202">
                                        <rect
                                            width="16"
                                            height="16"
                                            fill="white"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div
                            v-if="item.status === 9"
                            class="status"
                            datatype="replaceItem"
                            data-tip="Заменен"
                            currentitem="false"
                        >
                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g clip-path="url(#clip0_28342_45251)">
                                    <path
                                        d="M0.000182307 8.00084C0.000615846 8.42837 0.34757 8.77456 0.775132 8.77415C1.20269 8.77373 1.54897 8.42682 1.54853 7.99929L0.000182307 8.00084ZM5.09942 1.32491L4.79448 0.613363L4.79351 0.613776L5.09942 1.32491ZM9.14679 0.912035L9.3042 0.154074L9.30183 0.153568L9.14679 0.912035ZM13.7487 6.14952C13.8668 6.56043 14.2957 6.79773 14.7066 6.67965C15.1175 6.56157 15.355 6.1327 15.2368 5.72181L13.7487 6.14952ZM13.7434 5.74094C13.6359 6.15479 13.8842 6.57736 14.2981 6.68491C14.7119 6.79247 15.1345 6.54412 15.242 6.13032L13.7434 5.74094ZM15.9749 3.31046C16.0825 2.89666 15.8342 2.47403 15.4204 2.3665C15.0066 2.25896 14.5839 2.50723 14.4763 2.92103L15.9749 3.31046ZM14.2866 6.68182C14.6987 6.79567 15.1251 6.55393 15.2389 6.14188C15.3529 5.72974 15.111 5.30336 14.699 5.18949L14.2866 6.68182ZM11.9646 4.43394C11.5524 4.32006 11.126 4.56181 11.0121 4.97391C10.8983 5.38601 11.14 5.8124 11.5522 5.92627L11.9646 4.43394ZM15.9998 7.99929C15.9994 7.57166 15.6524 7.22547 15.2249 7.22588C14.7973 7.22629 14.451 7.57321 14.4514 8.00084L15.9998 7.99929ZM6.85316 15.088L6.69575 15.8459L6.69823 15.8464L6.85316 15.088ZM2.2513 9.8505C2.13318 9.43959 1.70431 9.2023 1.29339 9.32038C0.882454 9.43846 0.645081 9.86733 0.7632 10.2782L2.2513 9.8505ZM2.25653 10.259C2.36408 9.84534 2.1158 9.42267 1.70198 9.31511C1.28815 9.20756 0.865504 9.4559 0.757966 9.8697L2.25653 10.259ZM0.0250796 12.6896C-0.0824688 13.1034 0.165814 13.526 0.579637 13.6335C0.99345 13.7411 1.4161 13.4928 1.52365 13.079L0.0250796 12.6896ZM1.71344 9.31821C1.30132 9.20436 0.874918 9.4461 0.761042 9.85814C0.647156 10.2703 0.888926 10.6967 1.30105 10.8105L1.71344 9.31821ZM4.03543 11.5661C4.44755 11.6799 4.87397 11.4382 4.98784 11.0262C5.10173 10.614 4.85996 10.1876 4.44783 10.0738L4.03543 11.5661ZM1.54853 7.99929C1.54726 6.72455 1.91437 5.47665 2.60569 4.4057L1.30479 3.56605C0.45165 4.8877 -0.00138669 6.42769 0.000182307 8.00084L1.54853 7.99929ZM2.60569 4.4057C3.28243 3.35523 4.25741 2.52981 5.40534 2.03604L4.79351 0.613776C3.3627 1.22922 2.14829 2.25672 1.30479 3.56605L2.60569 4.4057ZM5.40437 2.03646C6.53503 1.55194 7.78661 1.42426 8.99185 1.6705L9.30183 0.153568C7.78754 -0.155797 6.21504 0.00462472 4.79448 0.613363L5.40437 2.03646ZM8.98937 1.67C10.2041 1.92225 11.3144 2.53493 12.1755 3.42801L13.2902 2.35343C12.2129 1.23615 10.8239 0.469663 9.3042 0.154074L8.98937 1.67ZM12.1755 3.42801C12.9143 4.19268 13.4549 5.12758 13.7487 6.14952L15.2368 5.72181C14.8731 4.45644 14.205 3.30025 13.2902 2.35343L12.1755 3.42801ZM15.242 6.13032L15.9749 3.31046L14.4763 2.92103L13.7434 5.74094L15.242 6.13032ZM14.699 5.18949L11.9646 4.43394L11.5522 5.92627L14.2866 6.68182L14.699 5.18949ZM14.4514 8.00084C14.4528 9.27548 14.0856 10.5234 13.3943 11.5944L14.6953 12.4339C15.5484 11.1123 16.0013 9.57233 15.9998 7.99929L14.4514 8.00084ZM13.3943 11.5944C12.7176 12.6449 11.7425 13.4703 10.5947 13.9639L11.2056 15.3867C12.6364 14.7712 13.8518 13.7433 14.6953 12.4339L13.3943 11.5944ZM10.5947 13.9639C9.4641 14.4485 8.21334 14.5757 7.00821 14.3295L6.69823 15.8464C8.21241 16.1558 9.78502 15.9954 11.2056 15.3867L10.5947 13.9639ZM7.01058 14.3301C5.79595 14.0778 4.68559 13.4651 3.82456 12.5721L2.70986 13.6466C3.78705 14.7639 5.17616 15.5304 6.69575 15.8459L7.01058 14.3301ZM3.82456 12.5721C3.08565 11.8073 2.54505 10.8725 2.2513 9.8505L0.7632 10.2782C1.12693 11.5436 1.79495 12.6997 2.70986 13.6466L3.82456 12.5721ZM0.757966 9.8697L0.0250796 12.6896L1.52365 13.079L2.25653 10.259L0.757966 9.8697ZM1.30105 10.8105L4.03543 11.5661L4.44783 10.0738L1.71344 9.31821L1.30105 10.8105Z"
                                        fill="url(#paint0_linear_28342_45251)"
                                    />
                                </g>
                                <defs>
                                    <linearGradient
                                        id="paint0_linear_28342_45251"
                                        x1="0"
                                        y1="0"
                                        x2="17.8961"
                                        y2="2.51664"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#1E2534" />
                                        <stop offset="1" stop-color="#151A25" />
                                    </linearGradient>
                                    <clipPath id="clip0_28342_45251">
                                        <rect
                                            width="16"
                                            height="16"
                                            fill="white"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div
                            v-if="item.status === 1"
                            class="status"
                            datatype="sell"
                            data-tip="Продан"
                            currentitem="false"
                        >
                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g clip-path="url(#clip0_140_35979)">
                                    <path
                                        d="M15.142 2.718C14.9545 2.49296 14.7197 2.31197 14.4544 2.18788C14.189 2.06379 13.8996 1.99964 13.6067 2H2.828L2.8 1.766C2.7427 1.27961 2.50892 0.831155 2.14299 0.505652C1.77706 0.180149 1.30442 0.000227862 0.814667 0L0.666667 0C0.489856 0 0.320286 0.0702379 0.195262 0.195262C0.0702379 0.320286 0 0.489856 0 0.666667C0 0.843478 0.0702379 1.01305 0.195262 1.13807C0.320286 1.2631 0.489856 1.33333 0.666667 1.33333H0.814667C0.977956 1.33335 1.13556 1.3933 1.25758 1.50181C1.3796 1.61032 1.45756 1.75983 1.47667 1.922L2.394 9.722C2.48923 10.5332 2.87899 11.2812 3.48927 11.824C4.09956 12.3668 4.8879 12.6667 5.70467 12.6667H12.6667C12.8435 12.6667 13.013 12.5964 13.1381 12.4714C13.2631 12.3464 13.3333 12.1768 13.3333 12C13.3333 11.8232 13.2631 11.6536 13.1381 11.5286C13.013 11.4036 12.8435 11.3333 12.6667 11.3333H5.70467C5.29204 11.3322 4.88987 11.2034 4.55329 10.9647C4.21671 10.726 3.96221 10.389 3.82467 10H11.7713C12.5529 10 13.3096 9.72549 13.9092 9.22429C14.5089 8.7231 14.9134 8.02713 15.052 7.258L15.5753 4.35533C15.6276 4.06734 15.6158 3.77138 15.5409 3.48843C15.4661 3.20547 15.3299 2.94245 15.142 2.718Z"
                                        fill="url(#paint0_linear_140_35979)"
                                    />
                                    <path
                                        d="M4.66927 16C5.40565 16 6.0026 15.403 6.0026 14.6666C6.0026 13.9303 5.40565 13.3333 4.66927 13.3333C3.93289 13.3333 3.33594 13.9303 3.33594 14.6666C3.33594 15.403 3.93289 16 4.66927 16Z"
                                        fill="url(#paint1_linear_140_35979)"
                                    />
                                    <path
                                        d="M11.3333 16C12.0697 16 12.6667 15.403 12.6667 14.6666C12.6667 13.9303 12.0697 13.3333 11.3333 13.3333C10.597 13.3333 10 13.9303 10 14.6666C10 15.403 10.597 16 11.3333 16Z"
                                        fill="url(#paint2_linear_140_35979)"
                                    />
                                </g>
                                <defs>
                                    <linearGradient
                                        id="paint0_linear_140_35979"
                                        x1="7.80369"
                                        y1="0"
                                        x2="7.80369"
                                        y2="12.6667"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#75CB7D" />
                                        <stop offset="1" stop-color="#419049" />
                                    </linearGradient>
                                    <linearGradient
                                        id="paint1_linear_140_35979"
                                        x1="4.66927"
                                        y1="13.3333"
                                        x2="4.66927"
                                        y2="16"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#75CB7D" />
                                        <stop offset="1" stop-color="#419049" />
                                    </linearGradient>
                                    <linearGradient
                                        id="paint2_linear_140_35979"
                                        x1="11.3333"
                                        y1="13.3333"
                                        x2="11.3333"
                                        y2="16"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#75CB7D" />
                                        <stop offset="1" stop-color="#419049" />
                                    </linearGradient>
                                    <clipPath id="clip0_140_35979">
                                        <rect
                                            width="16"
                                            height="16"
                                            fill="white"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div
                            v-if="item.status === 7"
                            class="status"
                            datatype="contracts"
                            data-tip="Использован в контракте"
                            currentitem="false"
                        >
                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M14.6693 2.16669H1.33594C1.0626 2.16669 0.835938 1.94002 0.835938 1.66669C0.835938 1.39335 1.0626 1.16669 1.33594 1.16669H14.6693C14.9426 1.16669 15.1693 1.39335 15.1693 1.66669C15.1693 1.94002 14.9426 2.16669 14.6693 2.16669Z"
                                    fill="url(#paint0_linear_4197_30632)"
                                />
                                <path
                                    d="M2.44531 1.66669V9.64669C2.44531 10.3 2.75198 10.92 3.27865 11.3134L6.75198 13.9134C7.49198 14.4667 8.51198 14.4667 9.25198 13.9134L12.7253 11.3134C13.252 10.92 13.5586 10.3 13.5586 9.64669V1.66669H2.44531ZM10.6653 9.16669H5.33198C5.05865 9.16669 4.83198 8.94002 4.83198 8.66669C4.83198 8.39335 5.05865 8.16669 5.33198 8.16669H10.6653C10.9386 8.16669 11.1653 8.39335 11.1653 8.66669C11.1653 8.94002 10.9386 9.16669 10.6653 9.16669ZM10.6653 5.83335H5.33198C5.05865 5.83335 4.83198 5.60669 4.83198 5.33335C4.83198 5.06002 5.05865 4.83335 5.33198 4.83335H10.6653C10.9386 4.83335 11.1653 5.06002 11.1653 5.33335C11.1653 5.60669 10.9386 5.83335 10.6653 5.83335Z"
                                    fill="url(#paint1_linear_4197_30632)"
                                />
                                <defs>
                                    <linearGradient
                                        id="paint0_linear_4197_30632"
                                        x1="8.0026"
                                        y1="1.16669"
                                        x2="8.0026"
                                        y2="2.16669"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#F8B434" />
                                        <stop offset="1" stop-color="#B9730D" />
                                    </linearGradient>
                                    <linearGradient
                                        id="paint1_linear_4197_30632"
                                        x1="8.00198"
                                        y1="1.66669"
                                        x2="8.00198"
                                        y2="14.3284"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#F8B434" />
                                        <stop offset="1" stop-color="#B9730D" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div
                            v-if="item.status === 8"
                            class="status"
                            datatype="upgrade"
                            data-tip="Использован в апгрейде"
                            currentitem="false"
                        >
                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g clip-path="url(#clip0_204_27154)">
                                    <path
                                        d="M1.88693 12.3427C1.1136 12.6914 0.353599 11.8314 0.793599 11.104L7.25693 0.417358C7.33375 0.289959 7.44218 0.184571 7.57172 0.111415C7.70126 0.0382589 7.8475 -0.000183105 7.99626 -0.000183105C8.14503 -0.000183105 8.29127 0.0382589 8.42081 0.111415C8.55035 0.184571 8.65878 0.289959 8.7356 0.417358L15.2003 11.104C15.6403 11.8307 14.8803 12.6914 14.1063 12.3427L11.1229 10.9974C11.038 10.959 10.9623 10.9027 10.9011 10.8324C10.8399 10.762 10.7946 10.6793 10.7684 10.5898C10.7422 10.5003 10.7357 10.4062 10.7492 10.314C10.7628 10.2217 10.7961 10.1335 10.8469 10.0554C10.8997 9.97456 10.9337 9.88299 10.9464 9.78735C10.9592 9.6917 10.9504 9.59442 10.9207 9.50262C10.8909 9.41083 10.841 9.32685 10.7747 9.25684C10.7083 9.18683 10.627 9.13256 10.5369 9.09802L9.5356 8.71602C9.39254 8.66105 9.26669 8.56901 9.17093 8.44936L8.6696 7.82669C8.5887 7.72588 8.4862 7.64453 8.36966 7.58862C8.25312 7.53272 8.12552 7.5037 7.99626 7.5037C7.86701 7.5037 7.73941 7.53272 7.62287 7.58862C7.50633 7.64453 7.40383 7.72588 7.32293 7.82669L6.8216 8.45002C6.7256 8.57002 6.5996 8.66136 6.45693 8.71602L5.4556 9.09802C5.36545 9.13249 5.28415 9.18671 5.21768 9.25669C5.15121 9.32666 5.10125 9.41064 5.07146 9.50244C5.04167 9.59424 5.0328 9.69155 5.04552 9.78723C5.05823 9.8829 5.0922 9.97452 5.14493 10.0554C5.19579 10.1335 5.22916 10.2217 5.24276 10.3139C5.25636 10.4061 5.24986 10.5002 5.22371 10.5896C5.19756 10.6791 5.15237 10.7618 5.09125 10.8322C5.03013 10.9026 4.95452 10.9589 4.8696 10.9974L1.88693 12.3427Z"
                                        fill="url(#paint0_linear_204_27154)"
                                    />
                                    <path
                                        d="M3.38161 16C2.44961 16 2.17694 14.7267 3.02694 14.344L7.64361 12.2627C7.75509 12.2124 7.87598 12.1864 7.99827 12.1864C8.12057 12.1864 8.24146 12.2124 8.35294 12.2627L12.9696 14.344C13.8196 14.7273 13.5469 16 12.6149 16H10.4336C10.2049 16 9.98494 15.9087 9.82294 15.7467L8.60961 14.5307C8.52941 14.4503 8.43413 14.3864 8.32922 14.3429C8.22432 14.2994 8.11185 14.277 7.99827 14.277C7.88469 14.277 7.77223 14.2994 7.66733 14.3429C7.56242 14.3864 7.46714 14.4503 7.38694 14.5307L6.17361 15.746C6.09345 15.8265 5.99818 15.8904 5.89327 15.934C5.78836 15.9776 5.67588 16 5.56227 16H3.38161Z"
                                        fill="url(#paint1_linear_204_27154)"
                                    />
                                </g>
                                <defs>
                                    <linearGradient
                                        id="paint0_linear_204_27154"
                                        x1="7.99693"
                                        y1="-0.000183105"
                                        x2="7.99693"
                                        y2="12.4227"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#5CB1FF" />
                                        <stop offset="1" stop-color="#396CF4" />
                                    </linearGradient>
                                    <linearGradient
                                        id="paint1_linear_204_27154"
                                        x1="7.99827"
                                        y1="12.1864"
                                        x2="7.99827"
                                        y2="16"
                                        gradientUnits="userSpaceOnUse"
                                    >
                                        <stop stop-color="#5CB1FF" />
                                        <stop offset="1" stop-color="#396CF4" />
                                    </linearGradient>
                                    <clipPath id="clip0_204_27154">
                                        <rect
                                            width="16"
                                            height="16"
                                            fill="white"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <div
                        class="skin__container size--medium"
                        :class="[getItemRarityClass(item.item.rarity)]"
                    >
                        <div class="inventory__item">
                            <div class="inventory__link" data-isuser="true">
                                <div class="inventory__item__price">
                                    {{ item.price }} ₽
                                </div>
                                <div class="inventory__item__image_wrapper">
                                    <img
                                        :srcset="
                                            'https://steamcommunity-a.akamaihd.net/economy/image/' +
                                            item.item.icon_url
                                        "
                                        :alt="item.item.market_hash_name"
                                        loading="lazy"
                                        decoding="async"
                                    />
                                </div>
                                <div class="inventory__item__footer">
                                    <div
                                        class="inventory__item__footer_left_side"
                                    >
                                        <div class="drops__names">
                                            <div
                                                class="text color--secondary-text variant--h6"
                                            >
                                                {{
                                                    getItemType(
                                                        item.item
                                                            .market_hash_name
                                                    )
                                                }}
                                            </div>
                                            <div class="name__bottom">
                                                <span
                                                    class="text color--disabled variant--h4 bold noWrap"
                                                >
                                                    {{
                                                        getItemName(
                                                            item.item
                                                                .market_hash_name
                                                        )
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="inventory-item__backdrop">
                            <div
                                class="inventory-item__background"
                                :class="[getItemRarityClass(item.item.rarity)]"
                            ></div>
                        </div>
                        <div
                            class="skinCard__divider"
                            :class="[getItemRarityClass(item.item.rarity)]"
                        ></div>
                    </div>
                    <div class="blocker" v-if="item.status === 2">
                        <div class="loader">
                            <div class="loader white">
                                <span></span><span></span><span></span>
                            </div>
                        </div>
                        <div class="text color--inherit variant--h20 bold">
                            Закупаем предмет...
                        </div>
                    </div>
                    <div class="blocker" v-if="item.status === 3">
                        <div class="loader">
                            <div class="loader white">
                                <span></span><span></span><span></span>
                            </div>
                        </div>
                        <div class="text color--inherit variant--h20 bold">
                            Ожидание продавца...
                        </div>
                    </div>
                    <div v-if="item.status === 5" class="blocker">
                        <a
                            class="controls color--green-light size--large fit-content hovered button"
                            :href="`https://steamcommunity.com/id/${$root.username}/tradeoffers/`"
                            target="_blank"
                            rel="noreferrer"
                        >
                            <div class="button__content">
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M9.42969 15.9307L4.89292 11.3939C4.55819 11.0592 4.01547 11.0592 3.68074 11.3939C3.346 11.7286 3.346 12.2714 3.68074 12.6061L8.8236 17.7489C9.15833 18.0837 9.70104 18.0837 10.0358 17.7489L20.3215 7.46323C20.6562 7.1285 20.6562 6.58579 20.3215 6.25105C19.9868 5.91632 19.444 5.91632 19.1093 6.25105L9.42969 15.9307Z"
                                        fill="white"
                                    />
                                </svg>

                                <div class="text variant--h20">
                                    Принять трейд
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="empty__alert" v-if="filteredItems.length < 1">
            <div class="empty__alert-text">У вас еще нет предметов.</div>
        </div>
        <div class="show_more__wrapper" v-if="filteredItems.length >= 1">
            <button
                :disabled="pagination.items.page === 1"
                @click="prevPage"
                class="controls color--gray-dark size--large fit--content button radius-14 min--48"
                type="button"
            >
                <div class="button__content">
                    <svg
                        width="7"
                        height="14"
                        viewBox="0 0 7 14"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M2.30168 7.00003L6.7682 1.64021C7.12176 1.21593 7.06444 0.585368 6.64016 0.231804C6.21588 -0.12176 5.58532 -0.0644362 5.23175 0.359841L0.231754 6.35984C-0.0772842 6.73069 -0.0772842 7.26936 0.231754 7.64021L5.23175 13.6402C5.58532 14.0645 6.21588 14.1218 6.64016 13.7682C7.06444 13.4147 7.12176 12.7841 6.7682 12.3598L2.30168 7.00003Z"
                            fill="#687894"
                        />
                    </svg>
                </div>
            </button>
            <button
                class="controls color--blue-gradient size--large fit--content button radius-14 min--48"
                type="button"
            >
                <div class="button__content">
                    {{ pagination.items.page }}
                </div>
            </button>
            <button
                :disabled="!pagination.items.more"
                @click="nextPage"
                class="controls color--gray-dark size--large fit--content button radius-14 min--48"
                type="button"
            >
                <div class="button__content">
                    <svg
                        width="7"
                        height="14"
                        viewBox="0 0 7 14"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M4.69832 6.99998L0.231804 12.3598C-0.12176 12.7841 -0.0644364 13.4146 0.35984 13.7682C0.784117 14.1218 1.41468 14.0644 1.76825 13.6402L6.76825 7.64016C7.07728 7.26931 7.07728 6.73064 6.76825 6.35979L1.76825 0.359791C1.41468 -0.0644863 0.784119 -0.12181 0.359842 0.231754C-0.0644347 0.585319 -0.121758 1.21588 0.231806 1.64016L4.69832 6.99998Z"
                            fill="#687894"
                        />
                    </svg>
                </div>
            </button>
        </div>
        <ReplaceItem
            v-if="showReplaceItemModal"
            :items="replaceItems"
            :replaceable="replaceable"
            @close="closeReplaceItemModal"
            @update-items="$emit('update-items')"
        />
    </div>
</template>

<script>
import axios from "axios";
import {
    getExteriorInsideBrackets,
    getItemName,
    getItemRarityClass,
    getItemType,
} from "../../helpers/helper.js";
import ReplaceItem from "../Modals/ReplaceItem.vue";
export default {
    components: {
        ReplaceItem,
    },
    data() {
        return {
            showReplaceItemModal: false, // Для управления видимостью модального окна
            replaceItems: [], // Данные для модального окна
            replaceable: [],
        };
    },
    props: {
        items: {
            type: Array,
            required: true,
        },
        pagination: {
            type: Object,
            required: true,
        },
        prevPage: {
            type: Function,
            required: true,
        },
        nextPage: {
            type: Function,
            required: true,
        },
        filteredItems: {
            type: Array,
            required: true,
        },
        sellSkin: {
            type: Function,
            required: true,
        },
        withdraw: {
            type: Function,
            required: true,
        },
    },
    methods: {
        async fetchSimilarItems(itemId) {
            try {
                const response = await axios.post("/user/getItems", {
                    item_id: itemId,
                });

                if (response.data.success) {
                    this.replaceable = response.data.replaceable;
                    this.replaceItems = response.data.items;
                    this.showReplaceItemModal = true;
                    console.log("Items:", this.replaceItems);
                    console.log("replaceable:", this.replaceable);
                } else {
                    console.error(
                        "Ошибка получения похожих предметов:",
                        response.data.message
                    );
                }
            } catch (error) {
                console.error("Ошибка при вызове API:", error);
            }
        },

        // Закрытие модального окна
        closeReplaceItemModal() {
            this.showReplaceItemModal = false;
        },
        getExteriorInsideBrackets,
        getItemName,
        getItemRarityClass,
        getItemType,
    },
    sockets: {
        setItemStatus: function (data) {
            if (!Array.isArray(this.items) || !this.items.length) {
                console.warn(
                    "Массив items пуст или неинициализирован:",
                    this.items
                );
                return;
            }

            const item = this.items.find((item) => item.id === data.id);
            if (item) {
                this.$set(item, "status", data.status); // Обновление через $set
            } else {
                console.warn(
                    `Предмет с ID ${data.id} не найден. Имеющиеся ID:`,
                    this.items.map((item) => item.id)
                );
            }
        },
    },
};
</script>
