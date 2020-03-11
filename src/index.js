const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText } = wp.editor;
const { withSelect } = wp.data;

registerBlockType('jusi/latest-posts', {
  title: __('Simple Latest Posts', 'jusi'),
  icon: 'list-view',
  category: 'jusi',
  attributes: {
    sectionTitle: {
      type: 'string',
      source: 'html',
      selector: '.jusi-block__section-title'
    }
  },

  edit: withSelect(select => {
    return {
      posts: select('core').getEntityRecords('postType', 'post', {
        per_page: 3
      })
    };
  })(({ posts, className }) => {
    if (!posts) {
      return 'Loading...';
    }

    if (posts && posts.length === 0) {
      return 'No posts';
    }

    // const post = posts[0];
    // console.info(post);

    return (
      <div className={`${className} jusi-block jusi-latest-posts`}>
        <h4 className="jusi-block__section-title">
          Section title here.
          {/* <RichText placeholder={__('Section title', 'jusi')} value={props.attributes.sectionTitle} onChange={onChangeSectionTitle} /> */}
        </h4>
        <ol>
          {posts.map(function(post) {
            return (
              <li className="jusi-block__post">
                <img src={post.jusi_featured_image_url} alt={post.title.rendered} />
                <h5 className="jusi-block__post-title">
                  <a href={post.link}>{post.title.rendered}</a>
                </h5>
              </li>
            );
          })}
        </ol>
      </div>
    );

    // const { className } = props;

    // const onChangeSectionTitle = newSectionTitle => {
    //   props.setAttributes({ sectionTitle: newSectionTitle });
    // };

    // return (
    //   <div className={`${className} jusi-block jusi-latest-posts`}>
    //     <h2 className="jusi-block__section-title">
    //       <RichText placeholder={__('Section title', 'jusi')} value={props.attributes.sectionTitle} onChange={onChangeSectionTitle} />
    //     </h2>
    //   </div>
    // );
  }),

  save(props) {
    return null;
  }
});
