@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" style="background-color: #F97316; color: white; border-color: #F97316; padding: 12px 25px; font-weight: 600; border-radius: 8px; box-shadow: 0 4px 6px rgba(249, 115, 22, 0.2); margin: 0 10px;">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" style="background-color: #F97316; color: white; border-color: #F97316; padding: 12px 25px; font-weight: 600; border-radius: 8px; box-shadow: 0 4px 6px rgba(249, 115, 22, 0.2); margin: 0 10px; transition: all 0.3s ease;" 
                       onmouseover="this.style.backgroundColor='#EA580C'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 8px rgba(249, 115, 22, 0.3)';" 
                       onmouseout="this.style.backgroundColor='#F97316'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(249, 115, 22, 0.2)';" 
                       href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" style="background-color: #10B981; color: white; border-color: #10B981; padding: 12px 25px; font-weight: 600; border-radius: 8px; box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2); margin: 0 10px; transition: all 0.3s ease;" 
                       onmouseover="this.style.backgroundColor='#059669'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 8px rgba(16, 185, 129, 0.3)';" 
                       onmouseout="this.style.backgroundColor='#10B981'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(16, 185, 129, 0.2)';" 
                       href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" style="background-color: #10B981; color: white; border-color: #10B981; padding: 12px 25px; font-weight: 600; border-radius: 8px; box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2); margin: 0 10px;">Next</span>
                </li>
            @endif
        </ul>
    </nav>
@endif 