/**
 * Frontend React component for Related Posts
 * 
 * This file handles the client-side rendering of related posts.
 * It fetches data from our custom REST API and displays it dynamically.
 */

import { createRoot } from '@wordpress/element';
import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import placeholderImage from '../img/placeholder-thumb.jpg';
import avatarPlaceholder from '../img/man.png';

/**
 * RelatedPostsView Component
 * 
 * @param {Object} props Component properties
 * @param {number} props.postId Current post ID
 * @param {number} props.postsToShow Number of posts to display
 * @param {string} props.dateFormat PHP date format string
 */
function RelatedPostsView({ postId, postsToShow, dateFormat }) {
	const [posts, setPosts] = useState([]);
	const [loading, setLoading] = useState(true);
	const [error, setError] = useState(null);

	/**
	 * Fetch related posts from REST API
	 * Runs when component mounts or when dependencies change
	 */
	useEffect(() => {
		// Build API URL with parameters
		const apiUrl = `/wcc/v1/related-posts?post_id=${postId}&limit=${postsToShow}&format=${encodeURIComponent(dateFormat)}`;
		
		apiFetch({ path: apiUrl })
			.then((data) => {
				if (data.success && data.related_posts) {
					setPosts(data.related_posts);
				}
				setLoading(false);
			})
			.catch((err) => {
				console.error('Error fetching related posts:', err);
				setError(err.message || 'Failed to load related posts');
				setLoading(false);
			});
	}, [postId, postsToShow, dateFormat]);

	// Loading state
	if (loading) {
		return (
			<div className="related-posts-loading">
				<p>Loading related posts...</p>
			</div>
		);
	}

	// Error state
	if (error) {
		return (
			<div className="related-posts-error">
				<p>Unable to load related posts.</p>
			</div>
		);
	}

	// No posts found
	if (!posts || posts.length === 0) {
		return null;
	}

	// Success: Render the posts
	return (
		<div className="related-posts-container">
			<h3 className="related-posts-title">Related Posts</h3>
			<div className="related-posts-grid">
                {posts.map((post) => (
                    <article key={post.id} className="related-post-card">
                        <div className="related-post-image">
                            <a href={post.url}>
                                <img 
                                    src={post.featured_image || placeholderImage} 
                                    alt={post.title}
                                    loading="lazy"
                                    className={!post.featured_image ? 'placeholder' : ''}
                                />
                            </a>
                        </div>
                        
                        <div className="related-post-content">
                            <h4 className="related-post-title">
                                <a href={post.url}>{post.title}</a>
                            </h4>
                            
                            <div className="related-post-excerpt">
                                {post.excerpt}
                            </div>
                            
                            <div className="related-post-meta">
                                <img 
                                    src={post.author_avatar || avatarPlaceholder}
                                    alt={post.author || 'Author'}
                                    className="related-post-author-avatar"
                                    loading="lazy"
                                />
                                <div className="user-info">
                                    {post.author && <h5>{post.author}</h5>}
                                    <span>
                                        <time 
                                            className="related-post-date"
                                            dateTime={post.date}
                                        >
                                            {post.date}
                                        </time>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>
                ))}
			</div>
		</div>
	);
}

/**
 * Initialize React components for all related-posts blocks on the page
 * This runs when the DOM is fully loaded
 */
document.addEventListener('DOMContentLoaded', () => {
	// Find all related posts block containers
	const blocks = document.querySelectorAll('.wp-block-wcc-related-posts[data-post-id]');
	
	// Hydrate each block with React
	blocks.forEach((blockElement) => {
		// Get attributes from data attributes
		const postId = parseInt(blockElement.dataset.postId);
		const postsToShow = parseInt(blockElement.dataset.postsToShow) || 6;
		const dateFormat = blockElement.dataset.dateFormat || 'F j, Y';
		
		// Create React root and render component
		const root = createRoot(blockElement);
		root.render(
			<RelatedPostsView 
				postId={postId}
				postsToShow={postsToShow}
				dateFormat={dateFormat}
			/>
		);
	});
});

